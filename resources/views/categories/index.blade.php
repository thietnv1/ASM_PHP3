<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Danh muc</title>
</head>

<body>
    <h1>DANH MUC</h1>
    <a href="{{ route('categories.create')}}">Them moi </a>
    @if (session('msg'))
        <h2>{{ session('msg') }}</h2>
    @endif
    <table>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>CREAT</th>
            <th>UPDATE</th>
            <th>Action </th>
        </tr>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
                <td>
                    <a href="{{ route('categories.show', $item) }}">Show</a>
                    <a href="{{ route('categories.edit', $item) }}">sua</a>

                    <form action="{{ route('categories.destroy', $item) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" 
                        onclick=" return confirm('chan chan muon xoa !')"> Xoa </button>
                    </form>

                </td>
            </tr>
        @endforeach
    </table>
    {{-- {{$data->link()}} --}}
    {{ $data->links() }}
</body>

</html>
