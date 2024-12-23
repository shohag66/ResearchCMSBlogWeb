<!-- resources/views/users/create.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2>Create New User</h2>
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <label for="designation">Designation</label>
            <input type="text" class="form-control" id="designation" name="designation" value="{{ old('designation') }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
        </div>

        <div class="form-group">
            <label for="cv_link">CV Link</label>
            <input type="url" class="form-control" id="cv_link" name="cv_link" value="{{ old('cv_link') }}">
        </div>

        <div class="form-group">
            <label for="website_link">Website Link</label>
            <input type="url" class="form-control" id="website_link" name="website_link" value="{{ old('website_link') }}">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="current" {{ old('status') == 'current' ? 'selected' : '' }}>Current</option>
                <option value="life" {{ old('status') == 'life' ? 'selected' : '' }}>Life</option>
                <option value="alumni" {{ old('status') == 'alumni' ? 'selected' : '' }}>Alumni</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
</div>
@endsection
