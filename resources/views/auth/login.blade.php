<x-base-layout>
    <section class="bg-base-200 grow flex flex-col">
        <div class="flex grow">
            <form class="flex p-8 w-full lg:w-96 flex-col gap-8 justify-center" method="POST" action="{{ route('authenticate') }}" class="flex flex-col gap-4 mt-12">
                <h3 class="text-center font-bold text-2xl">Sacoda Serv</h3>
                @csrf
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-error">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input required placeholder="Email" value="{{ old('email') }}" name="email" type="email" class="input input-bordered w-full" >
                <input placeholder="Password" required name="password" type="password" class="input input-bordered w-full" >
                <input value="Login" type="submit" class="btn w-full btn-primary" >
            </form>
            <div style="background:url({{ Vite::asset('resources/images/login.jpeg') }}) center / cover" class="grow bg-primary overflow-hidden hidden lg:flex" />
        </div>
    </section>
</x-base-layout>
