<form method="POST" action="{{ route('password.store', ['type' => $type]) }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <input type="password" name="password_confirmation" required>
    <button type="submit">Réinitialiser le mot de passe</button>
</form>
