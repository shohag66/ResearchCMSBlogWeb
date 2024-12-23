<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required><br>

        <label for="password">Password (Leave empty to keep current):</label>
        <input type="password" id="password" name="password"><br>

        <label for="designation">Designation:</label>
        <input type="text" id="designation" name="designation" value="{{ $user->designation }}"><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description">{{ $user->description }}</textarea><br>

        <label for="profile_picture">Profile Picture:</label>
        <input type="file" id="profile_picture" name="profile_picture"><br>

        <label for="cv_link">CV Link:</label>
        <input type="url" id="cv_link" name="cv_link" value="{{ $user->cv_link }}"><br>

        <label for="website_link">Website Link:</label>
        <input type="url" id="website_link" name="website_link" value="{{ $user->website_link }}"><br>

        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="current" {{ $user->status == 'current' ? 'selected' : '' }}>Current</option>
            <option value="life" {{ $user->status == 'life' ? 'selected' : '' }}>Life</option>
            <option value="alumni" {{ $user->status == 'alumni' ? 'selected' : '' }}>Alumni</option>
        </select><br>

        <button type="submit">Update User</button>
    </form>
</body>
</html>
