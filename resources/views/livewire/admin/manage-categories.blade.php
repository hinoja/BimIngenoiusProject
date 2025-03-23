<div class="container">
    <div class="row justify-content-center h-100">
        <!-- Colonne de gauche : Formulaire -->
        <div class="col-lg-5 col-md-6 col-xs-12 d-flex flex-column">
            <div class="card border-0 rounded-lg flex-grow">
                <form class="h-100 d-flex flex-column" wire:submit.prevent="addCategory">
                    <div class="card-header bg-white border-bottom py-3">
                        <h4 class="card-title mb-0 text-emerald font-weight-bold">
                            <i class="fas fa-plus-circle mr-2"></i>@lang('Add a new Category')
                        </h4>
                    </div>
                    <div class="card-body p-4 flex-grow-1">
                        <div class="form-group">
                            <label for="name" class="font-weight-bold text-dark">
                                <i class="fas fa-tag mr-1 text-muted"></i> @lang('Name')
                            </label>
                            <input type="text" placeholder="Ex: Architecture,Building Materials..." wire:model="name"
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="@lang('Enter the name of the category')">
                            <small class="form-text text-muted mt-2">
                                @lang('Enter a category name') (@lang('required')).
                            </small>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top py-3 mt-auto">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                <i class="fas fa-plus-circle mr-1"></i> @lang('Add')
                            </span>
                            <span wire:loading>
                                <i class="fas fa-spinner fa-spin mr-1"></i> @lang('Processing...')
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Colonne de droite : Liste des catégories -->
        <div class="col-lg-7 col-md-6 col-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">@lang('Name')</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button wire:click="showEditForm({{ $category->id }})" type="button"
                                                    class="btn btn-sm btn-primary mr-1" data-toggle="tooltip"
                                                    title="Modifier" wire:loading.attr="disabled">
                                                    <span wire:loading wire:target="showEditForm({{ $category->id }})">
                                                        <i class="fas fa-spinner fa-spin"></i>
                                                    </span>
                                                    <span wire:loading.remove
                                                        wire:target="showEditForm({{ $category->id }})">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </button>
                                                <!-- Dans les boutons d'action -->
                                                <button wire:click="showDeleteForm({{ $category->id }})" type="button"
                                                    class="btn btn-sm btn-danger" wire:loading.attr="disabled">
                                                    <i class="fas fa-trash"></i>
                                                    <span wire:loading
                                                        wire:target="showDeleteForm({{ $category->id }})">
                                                        <i class="fas fa-spinner fa-spin ml-1"></i>
                                                    </span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                {{ $categories->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal addCategory + EditCategory -->
    @include('includes.back.categories.addEditModal')

    <!-- Modal Delete Category -->
    @include('includes.back.categories.confirmationDeleteModal')
</div>
