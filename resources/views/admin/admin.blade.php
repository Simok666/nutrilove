<x-admin.layout title="Blank">
    <x-slot name="styles">
        <style>
          
        </style>
    </x-slot>

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

    <x-slot name="scripts">
        <script>
            const ClickMe = () => alert("Oyi Sing kedua")
        </script>
    </x-slot>

</x-admin.layout>
