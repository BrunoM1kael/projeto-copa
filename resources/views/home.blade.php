@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection


@section('scripts')
<script src="{{ asset('js/home.js') }}"></script>
@endsection

<h1>Modos de Jogo</h1>

<div class="competition-selection">
    <button id="btn-copa-do-mundo">Jogar a Copa do Mundo</button>
    <button id="btn-super-mundial">Disputar o Super Mundial de Clubes</button>
</div>

<div id="config-copa-do-mundo" class="competition-config" style="display: none;">
    <button id="btn-voltar-copa" class="btn-back">&larr; Voltar</button>
    <h3>Configuração da Copa do Mundo</h3>
    <div class="form-container">
        <div class="form-item">
            <form action="{{ route('add.grupos', 'normal') }}">
                <button type="submit">Grupos 2022 Padrão</button>
            </form>
            <div class="button-description">Grupos fixos conforme o sorteio oficial de 2022.</div>
        </div>
        <div class="form-item">
            <form action="{{ route('add.grupos', 'random') }}">
                <button type="submit">Grupos 2022 Aleatórios</button>
            </form>
            <div class="button-description">Times distribuídos aleatoriamente nos grupos.</div>
        </div>
        <div class="form-item">
            <form action="{{ route('add.grupos', 'random.pote') }}">
                <button type="submit">Grupos 2022 por Pote</button>
            </form>
            <div class="button-description">Distribuição dos times considerando os potes do sorteio.</div>
        </div>
        <div class="form-item">
            <form action="{{ route('add.grupos', 'times') }}">
                <button type="submit">Criar Times</button>
            </form>
            <div class="button-description">Permite criar seus próprios times personalizados.</div>
        </div>
    </div>
</div>

<div id="config-super-mundial" class="competition-config" style="display: none;">
    <button id="btn-voltar-super" class="btn-back">&larr; Voltar</button>
    <h3>Configuração do Super Mundial de Clubes</h3>
    <div class="form-container">
        <div class="form-item">
            <form action="{{ route('add.grupos', 'normal.s') }}">
                <button type="submit">Grupos Super Mundial Padrão</button>
            </form>
            <div class="button-description">Grupos fixos do Super Mundial de Clubes.</div>
        </div>
        <div class="form-item">
            <form action="{{ route('add.grupos', 'random.s') }}">
                <button type="submit">Grupos Super Mundial Aleatórios</button>
            </form>
            <div class="button-description">Times do Super Mundial distribuídos aleatoriamente.</div>
        </div>
        <div class="form-item">
            <form action="{{ route('add.grupos', 'times.s') }}">
                <button type="submit">Criar Times Super Mundial</button>
            </form>
            <div class="button-description">Permite criar seus próprios times para o Super Mundial.</div>
        </div>
    </div>
</div>


