<?php
// Configurações básicas e headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');

// Define a pasta de uploads
$uploadDir = __DIR__ . '/uploads/'; 
// NOTA: Certifique-se de que esta pasta existe e tem permissão de escrita!

/**
 * Processa o arquivo CSV, lendo o cabeçalho e todas as linhas de dados.
 * @param string $filePath Caminho para o arquivo CSV.
 * @return array Um array contendo o cabeçalho (headers) e os dados (data).
 */
function parseCsvFile($filePath) {
    $data = [];
    $headers = [];
    $row = 0;

    // Abre o arquivo para leitura
    if (($handle = fopen($filePath, "r")) !== FALSE) {
        
        while (($line = fgetcsv($handle, 1000, ",")) !== FALSE) {
            
            // Primeira linha é o cabeçalho
            if ($row == 0) {
                // Remove espaços em branco e padroniza chaves
                $headers = array_map(function($h) {
                    return trim(strtolower(str_replace([' ', '-'], '_', $h)));
                }, $line);
                $row++;
                continue;
            }
            
            // Verifica se o número de colunas bate com o cabeçalho
            if (count($line) !== count($headers)) {
                // Pode ser um erro ou apenas uma linha mal formatada (pulamos)
                error_log("Aviso: Linha {$row} do CSV ignorada por ter número incorreto de colunas.");
                $row++;
                continue;
            }

            // Mapeia os dados da linha com o cabeçalho
            $rowData = [];
            foreach ($headers as $index => $header) {
                // Tentativa de conversão para número, se aplicável
                $value = trim($line[$index]);
                if (is_numeric($value)) {
                    $rowData[$header] = (float) $value;
                } else {
                    $rowData[$header] = $value;
                }
            }
            $data[] = $rowData;
            $row++;
        }
        
        fclose($handle);
    } else {
        throw new Exception("Não foi possível abrir o arquivo CSV para leitura.");
    }

    return [
        'headers' => $headers,
        'data' => $data
    ];
}


// --- Lógica da API ---

$method = $_SERVER['REQUEST_METHOD'] ?? '';

if ($method === 'POST') {
    
    $result = ['success' => false, 'data' => null, 'error' => ''];

    try {
        if (empty($_FILES['csv_file'])) {
            throw new Exception("Nenhum arquivo CSV foi enviado.");
        }
        
        $file = $_FILES['csv_file'];
        
        // 1. Verificação inicial do arquivo
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Erro de upload: Código " . $file['error']);
        }
        
        // Verifica tipo MIME simples (pode variar muito em CSV, então é cauteloso)
        $allowedExt = 'csv';
        $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (strtolower($fileExt) !== $allowedExt) {
             throw new Exception("Tipo de arquivo não permitido. Apenas arquivos .$allowedExt são aceitos.");
        }

        // 2. Cria a pasta de uploads se não existir (se você não o fez manualmente)
        if (!is_dir($uploadDir)) {
             mkdir($uploadDir, 0777, true); 
             // O 0777 é para garantir o funcionamento em ambiente local.
        }

        // 3. Move o arquivo temporário para a pasta de uploads
        $tempFileName = uniqid('csv_', true) . '.csv';
        $tempFilePath = $uploadDir . $tempFileName;
        
        if (!move_uploaded_file($file['tmp_name'], $tempFilePath)) {
            throw new Exception("Falha ao mover o arquivo de upload. (Verifique as permissões da pasta 'uploads'!)");
        }

        // 4. Processa o arquivo
        $parsedData = parseCsvFile($tempFilePath);
        
        $result['success'] = true;
        $result['data'] = $parsedData;

        // 5. Limpeza: Apaga o arquivo temporário
        unlink($tempFilePath);

    } catch (Exception $e) {
        http_response_code(400);
        $result['error'] = $e->getMessage();
    }

    echo json_encode($result);
    
} elseif ($method === 'OPTIONS') {
    http_response_code(200);
    exit();
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Método não permitido.']);
}
