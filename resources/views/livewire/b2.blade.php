
<div class="page-content">
    <div class="wizard-heading">FORMULAIRE D'ADHÉSION</div>
    <div class="wizard-v7-content">
        <div class="wizard-form">
            <form class="form-register" wire:submit.prevent="submit">
                <div id="form-total">
                    <!-- Étape 1 : Références de l'adhérent -->
                    <h2>
                        <p class="step-icon"><span>1</span></p>
                        <div class="step-text">
                            <span class="step-inner-1">Références</span>
                            <span class="step-inner-2">Références de l'adhérent</span>
                        </div>
                    </h2>
                    <section class="inner">
                        <div class="wizard-header">
                            <h3 class="heading">Références de l'adhérent</h3>
                        </div>
                        <!-- Matricule -->
                        <div class="form-row">
                            <div class="form-holder form-holder-2">
                                <label for="matricule">Matricule</label>
                                <input wire:model="matricule" id="matricule" class="form-control"  type="text">
                                @error('matricule') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <!-- NIP -->
                        <div class="form-row">
                            <div class="form-holder form-holder-2">
                                <label for="nip">NIP</label>
                                <input wire:model="nip" id="nip" class="form-control"  type="text">
                                @error('nip') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <!-- N° CNIB -->
                        <div class="form-row">
                            <div class="form-holder form-holder-2">
                                <label for="nip">N° CNIB</label>
                                <input wire:model="cnib" id="cnib" class="form-control"  type="text">
                                @error('cnib') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <!-- Délivré le -->
                        <div class="form-row">
                            <div class="form-holder form-holder-2">
                                <label for="delivree">Délivré le</label>
                                <input wire:model="delivree" id="delivree" class="form-control"  type="date" wire:change="updateExpire">
                                @error('delivree') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <!-- Expire le -->
                        <div class="form-row">
                            <div class="form-holder form-holder-2">
                                <label for="expire">Expire le</label>
                                <input wire:model="expire" id="expire" class="form-control" type="date">
                                @error('expire') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <!-- Adresse permanente -->
                        <div class="form-row">
                            <div class="form-holder form-holder-2">
                                <label for="adresse_permanente">Adresse permanente</label>
                                <input wire:model="adresse_permanente" id="adresse_permanente" class="form-control"  type="text">
                                @error('adresse_permanente') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <!-- Téléphone -->
                        <div class="form-row">
                            <div class="form-holder form-holder-2">
                                <label for="telephone">Téléphone</label>
                                <input wire:model="telephone" id="telephone" class="form-control"  type="text">
                                @error('telephone') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="form-row">
                            <div class="form-holder form-holder-2">
                                <label for="email">Email</label>
                                <input wire:model="email" id="email" class="form-control"  type="email">
                                @error('email') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </section>

                    <!-- Étape 2 : État civil -->
                    <h2>
                        <p class="step-icon"><span>2</span></p>
                        <div class="step-text">
                            <span class="step-inner-1">État civil</span>
                            <span class="step-inner-2">Informations officielles</span>
                        </div>
                    </h2>
                    <section>
                        <div class="inner">
                            <div class="wizard-header">
                                <h3 class="heading">État civil</h3>
                            </div>
                        </div>
                        <!-- Nom -->
                        <div class="form-row">
                            <div class="form-holder form-holder-2">
                                <label for="nom">Nom</label>
                                <input wire:model="nom" id="nom" class="form-control"  type="text" required>
                                @error('nom') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <!-- Prénom -->
                        <div class="form-row">
                            <div class="form-holder form-holder-2">
                                <label for="prenom">Prénom</label>
                                <input wire:model="prenom" id="prenom" class="form-control"  type="text" required>
                                @error('prenom') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </section>

                    
                </div>
                <div class="wizard-footer">
                    <button wire:click="submit" class="btn btn-primary">Soumettre</button>
                </div>
            </form>
        </div>
    </div>
</div>
