<x-app-layout>
    {{-- Awal Form --}}
    <div class="flex justify-center py-5">
        <div
            class="block w-1/2 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <form action="{{ route('alternatif.update', $alternatif->id) }}" method='post' enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    <div class="alert alert-danger mt-3" role="alert" id="danger-alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <script>
                        setTimeout(function() => {
                            var succsesAlert = document.getElementById('danger-alert');
                            succsesAlert.style.display = 'none';
                        }, 5000);
                    </script>
                @endif
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name='nama' id="nama"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required value={{ $alternatif->nama }} />
                    <label for="nama"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name='keterangan' id="keterangan" step="0.01"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required value={{ $alternatif->keterangan }} />
                    <label for="keterangan"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Keterangan</label>
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>
    </div>
    {{-- Akhir Form --}}
</x-app-layout>
