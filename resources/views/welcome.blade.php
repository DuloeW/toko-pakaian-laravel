@extends('layouts.master')

@section('title', 'Dasboard')

@section('content')
    <div class="w-full h-screen px-10 py-5 flex flex-col gap-16 overflow-hidden">
        <div class="flex w-full h-fit pb-8 justify-between items-center border-b-2 border-green-800">
            <h1 class="text-3xl">Dasboard</h1>
            <div>
                <form action="/get-item" method="post" class=" flex justify-between gap-5">
                    @csrf
                    @method('POST')
                    <input type="text" name="keyword" placeholder="Item name's......."
                        class="p-2 w-72 border-none outline-none shadow-xl placeholder:tracking-widest">
                    <button class="px-3 bg-green-800 text-white font-medium rounded-md ">Find</button>
                </form>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block h-96 overflow-y-auto min-w-full py-2 sm:px-6 lg:px-8">
                    <table class="min-w-full h-full text-left text-sm font-light">
                        <thead class="border-b font-medium sticky -top-5 bg-white dark:border-neutral-500 ">
                            <tr>
                                <th scope="col" class="px-6 py-4">Kode Barang</th>
                                <th scope="col" class="px-6 py-4">Jenis Barang</th>
                                <th scope="col" class="px-6 py-4">Merek Barang</th>
                                <th scope="col" class="px-6 py-4">Stock Barang</th>
                                <th scope="col" class="px-6 py-4">Harga Barang</th>
                                <th scope="col" class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $item->kode_barang }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $item->jenis_barang }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $item->merek_barang }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $item->stok_barang }}</td>
                                    <td id="currency" class="whitespace-nowrap px-6 py-4"> {{ $item->harga_barang }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 h-full w-full flex justify-end items-center gap-5">
                                        <form action="/get/item/{{ $item->kode_barang }}">
                                            <button id="edit">Edit</button>
                                        </form>
                                        <form action="/delete-data/{{ $item->kode_barang }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button id="delete" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex mt-2 justify-between">
                <div>
                    Page <span class="px-2 border-2 border-green-600">{{ $items->currentPage() }}</span> - <span
                        class="px-2 border-2 border-green-600">{{ $items->total() }}</span>
                </div>
                <div class="flex gap-10">
                    <a href="{{ $items->previousPageUrl() }}" class="px-6 border-2 border-cyan-600">
                        <button>Previous</button>
                    </a>
                    <a href="{{ $items->nextPageUrl() }}" class="px-6 border-2 border-green-800">
                        <button>Next</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
<style scoped>
    #edit,
    #delete {
        padding: 5px 15px;
        background: red;
        color: #ffffff;
        font-weight: 700;
    }

    #edit {
        background: green;
    }
</style>
