<x-layout title="Athletes">
    <h1 class="page_title">Liste des Athletes</h1>
    @if(!empty($athletes))
        <table style="margin: auto">
            <tr>
                <th>Nom</th>
                <th>Nationalité</th>
                <th>Age</th>
            </tr>
            @foreach($athletes as $ath)
                <tr>
                    <td>{{$ath->nom}}</td>
                    <td>{{$ath->nationalite}}</td>
                    <td>{{$ath->age}}</td>
                </tr>
            @endforeach
        </table>
    @else
        <h3>aucun athletes</h3>
    @endif
</x-layout>
