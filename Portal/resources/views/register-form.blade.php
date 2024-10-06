@extends ('layouts.clear')

@section ('title')
    <title>Zarejestruj się</title>
@endsection

@section('body')
    <form action="/" method="post"  >
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Nazwa użytkownika</label>
            <input type="username" class="form-control" id="username" name="name" required>
            <div class="invalid-feedback">
                Podaj nazwę użytkownika
            </div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div class="invalid-feedback">
                Podaj email
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Hasło</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <div class="invalid-feedback">
                Podaj hasło
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Zarejestruj</button>
    </form>
@endsection
