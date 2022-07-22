<x-admin.layout title="Blank">
    @slot('styles')
        <style>
            .Color-ijo{
                color:red
            }
        </style>
    @endslot

    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title">Its Blank Page</h4>
                        <h4 class="card-title Color-ijo" onclick="ClickMe()">Click Me</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @slot('scripts')
        <script>
            const ClickMe = () => alert("Oyi");
        </script>
    @endslot
   
    {{-- Ini cara yang ke 2  --}}
    
   {{-- 
        <x-slot name="scripts">
            <script>
                const ClickMe = () => alert("Oyi Sing kedua")
            </script>
        </x-slot> 
    --}}
</x-admin.layout>
