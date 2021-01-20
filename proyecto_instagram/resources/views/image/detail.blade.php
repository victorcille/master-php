@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @include('includes.message')

            <div class="card pub_image pub_image_detail">
                <div class="card-header">
                    @if($image->user->image)
                    <div class='container-avatar'>
                        <!--<img src="{{ url('/user/avatar/' . Auth::user()->image) }}" />-->
                        <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" class="avatar" />
                    </div>
                    @endif

                    <div class="data-user">
                        {{ $image->user->name . ' ' . $image->user->surname }}
                        <span class="nickname">
                            {{ ' | @' . $image->user->nick }}
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    <div class='image-container image-detail'>
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
                    
                    {{-- Si el usuario identificado es el dueño de la publicación, ponemos los botones de actualizar y borrar la publicación --}}
                    @if(Auth::user() && Auth::user()->id == $image->user_id)
                        <div class="actions">
                            <a href="{{ route('image.edit', ['id' => $image->id]) }}" class="btn btn-sm btn-primary">Actualizar</a>
                            
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal">
                              Eliminar
                            </button>

                            <!-- The Modal -->
                            <div class="modal" id="myModal">
                              <div class="modal-dialog">
                                <div class="modal-content">

                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Eliminar publicación</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>

                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    Si eliminas esta imagen no podrás recuperarla, ¿estás seguro?
                                  </div>

                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                                    <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-danger">Borrar definitivamente</a>
                                  </div>

                                </div>
                              </div>
                            </div>
                        </div>
                    @endif
                    
                    {{-- Esta clase clearfix se usa para limpiar los flotados --}}
                    <div class="clearfix"></div>
                    
                    <div class="comments">
                        <h2>Comentarios ({{ count($image->comments) }})</h2>
                        <hr />
                        
                        <form method="POST" action="{{ route('comment.save') }}">
                            @csrf
                            
                            <input type="hidden" name="image_id" value="{{ $image->id }}" />
                            
                            <p>
                                <textarea id="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content"></textarea>
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </p>
                            
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </form>
                        
                        <hr />
                        
                        {{-- Listamos todos los comentarios de la imagen --}}
                        @foreach($image->comments as $comment)
                            <div class="comment">
                                <span class="nickname">{{ '@' . $comment->user->nick }}</span>
                                <span class="nickname date">{{ ' | ' . \FormatTime::LongTimeFilter($comment->created_at) }}</span>
                                <p>
                                    {{ $comment->content }}
                                    
                                    <br />
                                    
                                    {{-- Esta condición que ponemos aquí es la misma del método delete() del CommentController --}}
                                    @if(Auth::check() && (Auth::user()->id == $comment->user_id || Auth::user()->id == $comment->image->user_id))
                                        <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger">Eliminar</a>
                                    @endif
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>
@endsection
