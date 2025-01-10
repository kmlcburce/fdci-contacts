@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($contact) ? 'Edit' : 'Create' }} Contact</h1>
    <form action="{{ isset($contact) ? route('contacts.update', $contact->id) : route('contacts.store') }}" method="POST">
        @csrf
        @if(isset($contact)) @method('PUT') @endif
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $contact->name ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $contact->email ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" name="phone" value="{{ old('phone', $contact->phone ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" name="address">{{ old('address', $contact->address ?? '') }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
