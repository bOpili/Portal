@extends ('layouts.clear')

@section ('title')
    <title>Zaloguj się</title>
@endsection

@section('body')
    <form action="/" method="post">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" required>
            <div class="invalid-feedback">
                Podaj email
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Hasło</label>
            <input type="password" class="form-control" id="password" required>
            <div class="invalid-feedback">
                Podaj hasło
            </div>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="rememberUser">
            <label class="form-check-label" for="rememberUser">Zapamiętaj mnie</label>
        </div>
        <button type="submit" class="btn btn-primary">Zaloguj</button>
    </form>

    <div class="mx-2">Nie masz konta?<register-button class="mx-2"></register-button></div>
@endsection
