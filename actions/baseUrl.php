<?php 
function baseUrl($nomeURL = "") {
    return "http://localhost/cursos/" . ltrim($nomeURL, '/');
}