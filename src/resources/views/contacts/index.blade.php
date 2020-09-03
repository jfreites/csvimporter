@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center mt-4">Contacts</h2>

        <p class="text-right"><a href="{{ route('contact.importer') }}">Load contacts</a></p>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td><a href="#">See more</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <p class="text-center py-2">{{ $contacts->links() }}</p>
    </div>
@endsection