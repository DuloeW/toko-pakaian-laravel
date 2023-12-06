@extends('layouts.master')

@section('title', 'Add Item')

@section('content')
    <form action="/add" method="post" class="w-full relative px-10 h-screen py-2 flex flex-col gap-5 overflow-hidden ">
        @csrf
        @method('POST')

        <h1 class="text-3xl font-semibold pb-4 tracking-wider border-b-2 border-green-800">Add Item</h1>

        @if (Session::has('error'))
            <x-alert-message additional="bg-red-800" session="error" />
        @elseif (Session::get('success'))
            <x-alert-message additional="bg-green-500" session="success" />
        @endif

        <div class="w-full flex flex-wrap">
            <div class="box-input">
                <label for="">Kode Barang</label>
                <input type="text" name="kodeBarang" required>
            </div>

            <div class="box-input">
                <label for="">Jenis Barang</label>
                <select name="jenisBarang" id="" required>
                    <option value="baju">Baju</option>
                    <option value="celana">Celana</option>
                    <option value="sepatu">Sepatu</option>
                </select>
            </div>

            <div class="box-input">
                <label for="">Merek Barang</label>
                <input type="text" name="merekBarang" required>
            </div>

            <div class="box-input">
                <label for="">Stock Barang</label>
                <input type="number" name="stockBarang" required>
            </div>

            <div class="box-input">
                <div>
                    <label for="" class="mr-3">Harga Barang</label>
                    <select name="nominal" id="nominal">
                        <option value="ribu" selected>Ribu</option>
                        <option value="puluh">Puluh</option>
                        <option value="ratus">Ratus</option>
                        <option value="juta">Juta</option>
                    </select>
                </div>
                <div id="harga-inputs">
                    <input type="number" step="0.01" name="hargaBarang1" value="0" required>
                    <input type="number" step="0.01" name="hargaBarang2" value="000" required>
                </div>
            </div>
        </div>

        <div class="box-button w-1/5 flex self-end justify-between p-3">
            <button type="submit">Send</button>
            <button type="reset">Remove</button>
        </div>
    </form>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const nominalSelect = document.getElementById("nominal");
        const hargaInputsContainer = document.getElementById("harga-inputs");

        // Tambahkan event listener untuk menangani perubahan pada elemen <select>
        nominalSelect.addEventListener("change", function() {
            const selectedNominal = nominalSelect.value;
            hargaInputsContainer.innerHTML = ""; // Hapus semua elemen anak dari container

            if (selectedNominal === "ribu") {
                // Tambahkan dua input fields jika 'ribu' dipilih
                hargaInputsContainer.innerHTML = `
                    <input type="number" step="0.01" name="hargaBarang1" value="0" required>
                    <input type="number" step="0.01" name="hargaBarang2" value="000" required>
                `;
            } else if (selectedNominal === "puluh") {
                // Tambahkan dua input fields jika 'puluh' dipilih
                hargaInputsContainer.innerHTML = `
                    <input type="number" step="0.01" name="hargaBarang1" value="00" required>
                    <input type="number" step="0.01" name="hargaBarang2" value="000" required>
                `;
            } else if (selectedNominal === "ratus") {
                // Tambahkan dua input fields jika 'ratus' dipilih
                hargaInputsContainer.innerHTML = `
                    <input type="number" step="0.01" name="hargaBarang1" value="000" required>
                    <input type="number" step="0.01" name="hargaBarang2" value="000" required>
                `;
            } else if (selectedNominal === "juta") {
                // Tambahkan tiga input fields jika 'juta' dipilih
                hargaInputsContainer.innerHTML = `
                    <input type="number" step="0.01" name="hargaBarang1" value="0" required>
                    <input type="number" step="0.01" name="hargaBarang2" value="000" required>
                    <input type="number" step="0.01" name="hargaBarang3" value="000" required>
                `;
            }
        });
    });
</script>


<style scoped>
    .box-input {
        display: flex;
        flex-direction: column;
        /* background: red; */
        height: fit-content;
        width: 100%;
        padding: 10px;
    }

    .box-input input,
    .box-input select {
        padding: 10px;
        margin-top: 5px;
        background: #ffffff;
        box-shadow: 0px 5px 20px #e9e9e9;
        border-radius: 5px;
    }

    .box-button button {
        padding: 10px 15px;
        background: red;
        color: #fff;
        font-weight: 600;
        letter-spacing: 2px;
        border-radius: 5px;
        font-size:
    }

    .box-button button:nth-child(1) {
        background: green;
    }
</style>
