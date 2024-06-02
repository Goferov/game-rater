@extends('layout.main')

@section('content')
    <div class="card mt-3">
        <div class="card">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Gry</div>
            <div class="card-body">

                <form class="form-inline" action="{{ route('games.list') }}">
                    <div class="form-row">
                        <label class="my-1 mr-2" for="phrase">Szukana fraza:</label>
                        <div class="col">
                            <input type="text" class="form-control" name="phrase" placeholder="" value="{{ $phrase ?? '' }}">
                        </div>

                        @php
                        $selectedType = $selectedType ?? '';
                        @endphp
                        <div class="col-auto">
                            <select class="custom-select mr-sm-2" name="type">
                        @foreach($allTypes as $key => $type)
                                    <option @if ($selectedType == $key) selected @endif value="{{ $key }}">{{ $type }}</option>
                        @endforeach
                            </select>
                        </div>

                    <button type="submit" class="btn btn-primary mb-1">Wyszukaj</button>
            </div>
            </form>


            <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tytuł</th>
                            <th>Rodzaj</th>
                            <th>Ocena</th>
                            <th>Gatunek</th>
                            <th>Opcje</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Tytuł</th>
                            <th>Rodzaj</th>
                            <th>Ocena</th>
                            <th>Gatunek</th>
                            <th>Opcje</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($games ?? [] as $game)
                            <tr>
                                <td>{{ $game->id }}</td>
                                <td>{{ $game->name }}</td>
                                <td>{{ $game->type }}</td>
                                <td>{{ $game->score ?? 'brak' }}</td>
                                <td>{{ $game->genres->implode('name', ', ') }}</td>
                                <td>
                                    <a href="{{ route('games.show', ['game' => $game->id]) }}">Szczegóły</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $games->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
