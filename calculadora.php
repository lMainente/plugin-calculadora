<?php
function calcular_emissao_carbono($distancia, $modelo_carro, $tipo_combustivel) {
    $emissoes_combustivel = array(
        'gasolina' => 2.3,
        'diesel' => 2.7,
        'etanol' => 1.8,
        'gpl' => 1.5
    );
 
    $emissoes_modelo_carro = array(
        'modelo1' => 2.0,
        'modelo2' => 2.5,
        'modelo3' => 3.0
    );

    $emissao_carbono = $distancia * $emissoes_combustivel[$tipo_combustivel] * $emissoes_modelo_carro[$modelo_carro];

    return $emissao_carbono;
}

function exibir_calculadora_emissao_carbono() {
    ob_start();
    ?>

    <form method="POST">
        <label for="distancia">Distância percorrida (em km):</label>
        <input type="number" id="distancia" name="distancia" required>

        <label for="modelo_carro">Modelo do carro:</label>
        <select id="modelo_carro" name="modelo_carro" required>
            <option value="modelo1">Modelo 1</option>
            <option value="modelo2">Modelo 2</option>
            <option value="modelo3">Modelo 3</option>
        </select>

        <label for="tipo_combustivel">Tipo de combustível:</label>
        <select id="tipo_combustivel" name="tipo_combustivel" required>
            <option value="gasolina">Gasolina</option>
            <option value="diesel">Diesel</option>
            <option value="etanol">Etanol</option>
            <option value="gpl">GPL</option>
        </select>

        <input type="submit" value="Calcular">
    </form>

    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $distancia_percorrida = $_POST['distancia'];
        $modelo_carro_utilizado = $_POST['modelo_carro'];
        $tipo_combustivel = $_POST['tipo_combustivel'];

        $emissao_carbono_total = calcular_emissao_carbono($distancia_percorrida, $modelo_carro_utilizado, $tipo_combustivel);

        echo '<p>A emissão de carbono total é: ' . $emissao_carbono_total . ' kg CO2.</p>';
    }

    return ob_get_clean();
}
add_shortcode('calculadora_carbono', 'exibir_calculadora_emissao_carbono');

