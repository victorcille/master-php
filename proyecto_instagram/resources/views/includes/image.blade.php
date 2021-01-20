<div class="card pub_image">
    <div class="card-header">
        @if($image->user->image)
            <div class='container-avatar'>
                <!--<img src="{{ url('/user/avatar/' . Auth::user()->image) }}" />-->
                <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" class="avatar" />
            </div>
        @endif

        <div class="data-user">
            <a href="{{ route('profile', ['id' => $image->user_id]) }}">
                {{ $image->user->name . ' ' . $image->user->surname }}
                <span class="nickname">
                    {{ ' | @' . $image->user->nick }}
                </span>
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class='image-container'>
            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" />
        </div>

        <div class='description'>
            <span class="nickname">{{ '@' . $image->user->nick }}</span>
            <span class="nickname date">{{ ' | ' . \FormatTime::LongTimeFilter($image->created_at) }}</span>
            <p>{{ $image->description }}</p>
        </div>

        <div class='likes'>
            {{-- Comprobamos si el usuario le dió like a la imagen --}}
            <?php $user_like = false; ?>
            @foreach($image->likes as $like)
                @if($like->user_id == Auth::user()->id)
                    <?php $user_like = true; ?>
                @endif
            @endforeach

            @if($user_like)
                {{-- Para cambiar el tamaño en los iconos font-awesome se utiliza la clase fa-2x, fa-3x, etc... --}}
                {{-- Con el atributo data-id le pasamos el id de la imagen para luego cogerlo en el javascript y poder hacer
                    la llamada por AJAX --}}
                <i class="fas fa-heart fa-2x heart-like" data-id="{{ $image->id }}"></i>
            @else
                <i class="fas fa-heart fa-2x heart" data-id="{{ $image->id }}"></i>
            @endif

            {{-- Ponemos también un contador de todos los likes que tiene la imagen --}}
            <span class="number-likes">{{ count($image->likes) }}</span>
        </div>
        <div class="comments">
            <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="btn btn-sm btn-warning btn-comments">
                Comentarios ({{ count($image->comments) }})
            </a>
        </div>
    </div>
</div>