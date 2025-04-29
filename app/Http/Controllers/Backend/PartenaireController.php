<?php

namespace App\Http\Controllers\Backend;

use App\Models\Adherent;
use App\Models\Partenaire;

use Illuminate\Http\Request;
use App\Helpers\PasswordHelper;
use App\Mail\PartenaireAdhesion;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\Partenaires\PartenaireEmail;

use App\Http\Requests\StorePartenaireRequest;
use App\Http\Requests\UpdatePartenaireRequest;

class PartenaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Partenaires',
                'url' => route('partenaires.index'),
                'active' => true
            ],

        ];
        $pageTitle = 'Partenaires';

        $partenaires = Partenaire::all();

        $hopitaux = $partenaires->where('type', 'hopital');
        $cliniques = $partenaires->where('type', 'clinique');
        $pharmacies = $partenaires->where('type', 'pharmacie');

        return view('pages.backend.partenaires.index', [
            'partenaires' => $partenaires,
            'hopitaux' => $hopitaux,
            'cliniques' => $cliniques,
            'pharmacies' => $pharmacies,

            'breadcrumbsItems' => $breadcrumbsItems,
            'pageTitle' => $pageTitle,

        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Partenaires',
                'url' => route('partenaires.index'),
                'active' => false
            ],
            [
                'name' => 'Ajouter',
                'url' => route('partenaires.create'),
                'active' => true
            ],
        ];
        $pageTitle = 'Ajouter un partenaire';

        return view('pages.backend.partenaires.create', compact('breadcrumbsItems', 'pageTitle'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartenaireRequest $request)
    {
        try {
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos/partenaires', 'public');
            } else {
                $photoPath = null;
            }

            $validatedData = $request->validated();
            $validatedData['photo'] = $photoPath;

            $generatedPassword = PasswordHelper::generateSecurePassword();
            $validatedData['password'] = Hash::make($generatedPassword);
            $validatedData['must_change_password'] = true;

            $partenaire = Partenaire::create($validatedData);

            Mail::to($validatedData['email'])->send(new PartenaireAdhesion(
                $validatedData['email'],
                $generatedPassword // Assurez-vous que cette variable contient bien le mot de passe généré
            ));

            return redirect()
                ->route('partenaires.index')
                ->with('success', 'Partenaire de santé ajouté avec succès.');
        } catch (\Exception $e) {
            if (isset($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }

            return redirect()
                ->route('partenaires.index')
                ->with('error', 'Une erreur est survenue lors de l\'ajout du partenaire. Veuillez réessayer.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $partenaire = Partenaire::findOrFail($id);
        $breadcrumbsItems = [
            [
                'name' => 'Partenaires',
                'url' => route('partenaires.index'),
                'active' => false
            ],
            [
                'name' => $partenaire->nom,
                'url' => route('partenaires.show', $partenaire->id),
                'active' => true
            ],
        ];

        $pageTitle = 'Détails de ' . $partenaire->nom;
        return view('pages.backend.partenaires.show', compact('partenaire', 'breadcrumbsItems', 'pageTitle'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $partenaire = Partenaire::findOrFail($id);

        $breadcrumbsItems = [
            [
                'name' => 'Partenaires',
                'url' => route('partenaires.index'),
                'active' => false
            ],
            [
                'name' => $partenaire->nom,
                'url' => route('partenaires.index'),
                'active' => true
            ],
        ];

        $pageTitle = 'Édition de ' . $partenaire->nom;

        return view('pages.backend.partenaires.edit', compact('partenaire', 'breadcrumbsItems', 'pageTitle'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartenaireRequest $request,  $id)
    {
        $partenaire = Partenaire::findOrFail($id);

        $partenaire->update($request->validated());
        return redirect()->route('partenaires.index')->with('success', 'partenaire de santé mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $partenaireSante = Partenaire::findOrFail($id);
        $partenaireSante->delete();
        return redirect()->route('partenaires.index')->with('success', 'partenaire de santé supprimé avec succès.');
    }


    // Envoi de messages
    public function newEmail()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Partenaires',
                'url' => route('partenaires.mail'),
                'active' => true
            ],

        ];
        $pageTitle = 'Envoyer mail partenaires';

        $partenaires = Partenaire::all();

        // Tu peux stocker ou envoyer le message ici
        // Exemple : Mail::to(...)->send(new MessageEnvoye($request->message));

        return view('pages.backend.partenaires.mail', compact('partenaires', 'breadcrumbsItems', 'pageTitle'));
    }
    public function envoyerEmail(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'objet' => 'required|string',
            'email' => 'nullable|exists:partenaires,id', 
        ]);

        $message = nl2br(e($request->input('message')));
        $objet = $request->input('objet');

        if ($request->boolean('selectAll')) {
            // Tous les partenaires
            $partenaires = Partenaire::all();
        } else {
            // Un seul partenaire
            $partenaire = Partenaire::findOrFail($request->input('email'));
            $partenaires = collect([$partenaire]);
        }

        foreach ($partenaires as $partenaire) {
            try {
                Mail::to($partenaire->email)->send(new PartenaireEmail($message, $objet));
            } catch (\Throwable $e) {
                Log::error("Échec de l'envoi de l'email à {$partenaire->email} : " . $e->getMessage());
            }
        }
        return redirect()->route('partenaires.index')->with('success', 'Email(s) envoyé(s) avec succès.');

    }
}
