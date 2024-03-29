@extends('web.master.master')

@section('content')
    <div class="main_contact py-5 bg-light text-center">
        <div class="container">
            <h1 class="text-front">Entre em Contato Conosco</h1>
            <p class="mb-0 text-support">Quer conversar com um corretor exclusivo e ter o atendimento diferenciado em busca
                do seu imóvel
                dos sonhos?</p>
            <p class="text-support">Preencha o formulário abaixo e vamos lhe direcionar para alguém que entende a sua
                necessidade!</p>

            <div class="row text-left">
                <form action="#" method="post" class="shadow-sm">
                    @csrf
                    <h2 class="text-black-50"><i class="fa fa-envelope me-2"></i> Envie um e-mail</h2>
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Insira seu nome" required>
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Insira seu melhor e-mail"
                            required>
                    </div>

                    <div class="mb-3">
                        <input type="tel" name="cell" class="form-control"
                            placeholder="Insira seu telefone com DDD..." required>
                    </div>

                    <div class="mb-3">
                        <textarea name="message" rows="5" class="form-control" placeholder="Escreva sua mensagem..." required></textarea>
                    </div>

                    <div class="form-group text-right">
                        <button class="btn-custom text-opposit shadow-sm"><i class="fas fa-paper-plane me-2"></i> Enviar Contato</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="main_contact_types bg-white p-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 col-md-4">
                    <h2><i class="fa fa-envelope"></i> E-mail</h2>
                    <p>Nossos atendentes irão entrar em contato com você assim que possível.</p>
                    <p class="pt-2"><a href="mailto:contato@vmdimóveis.com.br"
                            class="text-front text-decoration-none">contato@vmdimoveis.com.br</a></p>
                </div>

                <div class="col-12 col-md-4">
                    <h2><i class="fa fa-phone-alt"></i> Por Telefone</h2>
                    <p>Estamos disponíveis nos números abaixo no horário comercial.</p>
                    <p class="pt-2 text-front">+55 (27) 99623-5139</p>
                    <p class="text-front">+55 (27) 99244-0238</p>
                </div>

                <div class="col-12 col-md-4">
                    <h2><i class="fa fa-share-alt"></i> Redes Sociais</h2>
                    <p>Fique por dentro do tudo o que a gente compartilha em nossas redes sociais!</p>
                    <p>
                        <a href="{{ env('CLIENT_DATA_LINK_FACEBOOK') }}" target="_blank"
                            class="btn-custom text-opposit"><i class="fab fa-facebook"></i></a>
                        <a href="{{ env('CLIENT_DATA_LINK_INSTAGRAM') }}" target="_blank"
                            class="btn-custom text-opposit mx-1"><i class="fab fa-instagram"></i></a>
                        <a href="{{ env('CLIENT_DATA_LINK_YOUTUBE') }}" target="_blank"
                            class="btn-custom text-opposit"><i class="fab fa-youtube"></i></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
