<x-app-layout>
    <div class="container mt-5">
        <h1>{{ isset($contact) ? 'Edit' : 'Create' }} Contact</h1>
        <form action="{{ isset($contact) ? route('contacts.update', $contact->id) : route('contacts.store') }}" method="POST">
            @csrf
            @if(isset($contact)) 
                @method('PUT') 
            @endif
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $contact->name ?? '') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $contact->email ?? '') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{ old('phone', $contact->phone ?? '') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="company" class="form-label">Company</label>
                    <input type="text" class="form-control" name="company" value="{{ old('company', $contact->company ?? '') }}">
                </div>
            </div>

            <!-- Hidden input to store the user_id -->
            @if(auth()->check())
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            @endif

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
