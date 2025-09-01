<?php
namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Models\Direction;
use App\Models\Service;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }
    
    public function show($id)
    {
        $user = User::findOrFail($id);
        $activities = Activity::causedBy($user)->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $user,
            'activities' => $activities, 
        ]);
    }
    
    public function directions()
    {
        // ✅ CORRECTION: Inclure les relations directeur et le count d'agents
        $dirs = Direction::with(['directeur:id,nom,prenom,email,direction_id'])
            ->withCount(['services as services_count', 'users as nombre_agents'])
            ->actif()
            ->ordered()
            ->get();

        // ✅ Transformer les données pour s'assurer du bon format
        $formattedDirs = $dirs->map(function ($direction) {
            return [
                'id' => $direction->id,
                'nom' => $direction->nom,
                'code' => $direction->code,
                'description' => $direction->description,
                'directeur_id' => $direction->directeur_id,
                'statut' => $direction->statut,
                'ordre' => $direction->ordre,
                // ✅ S'assurer que la relation directeur est bien formatée
                'directeur' => $direction->directeur ? [
                    'id' => $direction->directeur->id,
                    'nom' => $direction->directeur->nom,
                    'prenom' => $direction->directeur->prenom,
                ] : null,
                // ✅ Inclure les counts
                'services_count' => $direction->services_count ?? 0,
                'nombre_agents' => $direction->nombre_agents ?? 0,
                'created_at' => $direction->created_at,
                'updated_at' => $direction->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $formattedDirs
        ]);
    }

    // ✅ NOUVELLE MÉTHODE: Récupérer une direction spécifique
    public function getDirection($id)
    {
        try {
            $direction = Direction::with(['directeur:id,nom,prenom,email,direction_id', 'services'])
                ->withCount(['services as services_count', 'users as nombre_agents'])
                ->findOrFail($id);

            $formattedDirection = [
                'id' => $direction->id,
                'nom' => $direction->nom,
                'code' => $direction->code,
                'description' => $direction->description,
                'directeur_id' => $direction->directeur_id,
                'statut' => $direction->statut,
                'ordre' => $direction->ordre,
                'directeur' => $direction->directeur ? [
                    'id' => $direction->directeur->id,
                    'nom' => $direction->directeur->nom,
                    'prenom' => $direction->directeur->prenom,
                    'email' => $direction->directeur->email,
                ] : null,
                'services_count' => $direction->services_count ?? 0,
                'nombre_agents' => $direction->nombre_agents ?? 0,
                'services' => $direction->services,
                'created_at' => $direction->created_at,
                'updated_at' => $direction->updated_at,
            ];

            return response()->json([
                'success' => true,
                'data' => $formattedDirection
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Direction non trouvée',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function services($directionId)
    {
        $services = Service::where('direction_id', $directionId)
            ->with(['chefService:id,nom,prenom,email,service_id'])
            ->withCount(['users as nombre_agents'])
            ->ordered()
            ->get();

        $formattedServices = $services->map(function ($service) {
            return [
                'id' => $service->id,
                'nom' => $service->nom,
                'code' => $service->code,
                'direction_id' => $service->direction_id,
                'chef_service_id' => $service->chef_service_id,
                'statut' => $service->statut,
                'ordre' => $service->ordre,
                'chef_service' => $service->chefService ? [
                    'id' => $service->chefService->id,
                    'nom' => $service->chefService->nom,
                    'prenom' => $service->chefService->prenom,
                    'email' => $service->chefService->email,
                ] : null,
                'nombre_agents' => $service->nombre_agents ?? 0,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $formattedServices
        ]);
    }

    // ✅ NOUVELLE MÉTHODE: Récupérer un service spécifique
    public function getService($id)
    {
        try {
            $service = Service::with(['chefService:id,nom,prenom,email,service_id', 'direction'])
                ->withCount(['users as nombre_agents'])
                ->findOrFail($id);

            $formattedService = [
                'id' => $service->id,
                'nom' => $service->nom,
                'code' => $service->code,
                'description' => $service->description,
                'direction_id' => $service->direction_id,
                'chef_service_id' => $service->chef_service_id,
                'statut' => $service->statut,
                'ordre' => $service->ordre,
                'chef_service' => $service->chefService ? [
                    'id' => $service->chefService->id,
                    'nom' => $service->chefService->nom,
                    'prenom' => $service->chefService->prenom,
                    'email' => $service->chefService->email,
                ] : null,
                'direction' => $service->direction ? [
                    'id' => $service->direction->id,
                    'nom' => $service->direction->nom,
                    'code' => $service->direction->code,
                ] : null,
                'nombre_agents' => $service->nombre_agents ?? 0,
                'created_at' => $service->created_at,
                'updated_at' => $service->updated_at,
            ];

            return response()->json([
                'success' => true,
                'data' => $formattedService
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Service non trouvé',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    // ✅ NOUVELLE MÉTHODE: Statistiques d'agents pour un service
    public function getServiceStats($id)
    {
        try {
            $service = Service::findOrFail($id);
            $totalAgents = User::where('service_id', $id)->count();
            $activeAgents = User::where('service_id', $id)->where('statut', 'actif')->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'service_id' => $id,
                    'service_nom' => $service->nom,
                    'total' => $totalAgents,
                    'active' => $activeAgents,
                    'inactive' => $totalAgents - $activeAgents
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Service non trouvé',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function users(Request $request)
    {
        $query = User::query()->with(['roles','direction','service']);

        if ($request->filled('user_id')) {
            $query->where('id', $request->input('user_id'));
        }

        if ($request->filled('direction_id')) {
            $query->where('direction_id', $request->input('direction_id'));
        }

        if ($request->filled('service_id')) {
            $query->where('service_id', $request->input('service_id'));
        }

        if ($request->filled('role')) {
            $query->role($request->input('role'));
        }

        $users = $query->orderBy('nom')->get();

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    // ✅ NOUVELLE MÉTHODE: Créer un utilisateur
    public function createUser(Request $request)
    {
        try {
            $validated = $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'direction_id' => 'nullable|exists:directions,id',
                'service_id' => 'nullable|exists:services,id',
                'role' => 'nullable|string',
            ]);

            $user = User::create($validated);

            if ($request->filled('role')) {
                $user->assignRole($request->input('role'));
            }

            $user->load(['roles', 'direction', 'service']);

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Utilisateur créé avec succès'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de l\'utilisateur',
                'error' => $e->getMessage()
            ], 422);
        }
    }

    // ✅ NOUVELLE MÉTHODE: Mettre à jour un utilisateur
    public function updateUser(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validated = $request->validate([
                'nom' => 'sometimes|required|string|max:255',
                'prenom' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|unique:users,email,' . $id,
                'direction_id' => 'nullable|exists:directions,id',
                'service_id' => 'nullable|exists:services,id',
                'role' => 'nullable|string',
            ]);

            $user->update($validated);

            if ($request->filled('role')) {
                $user->syncRoles([$request->input('role')]);
            }

            $user->load(['roles', 'direction', 'service']);

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Utilisateur mis à jour avec succès'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour de l\'utilisateur',
                'error' => $e->getMessage()
            ], 422);
        }
    }

    // ✅ NOUVELLE MÉTHODE: Supprimer un utilisateur
    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Utilisateur supprimé avec succès'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de l\'utilisateur',
                'error' => $e->getMessage()
            ], 422);
        }
    }
}