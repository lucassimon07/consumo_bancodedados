<?php
	// Importação de scripts
	require_once '../model/db_connect.php';

	// Conexão com o banco
	$conn = dbConnect();
	
	// Validação da conexão, testando se a $conn é um objeto com a conexão dentro
	if (!is_object($conn)) {
		echo "<tr><td colspan='7'>Houve um problema de conexão com o banco: {$conn}</td></tr>";
		exit;
	}

	// SQL e bindings
	$sql = "SELECT * 
			FROM customers";
	$stmt = $conn->prepare($sql);

	if ($stmt->execute()) {
		$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rs as $row) {
			echo "<tr>
					<td>{$row['id']}</td>
					<td>" . mb_strimwidth($row['firs_name'], 0, 25, '...') . "</td>
					<td>" . mb_strimwidth($row['last_name'], 0, 50, '...') . "</td>
					<td>" . mb_strimwidth($row['email'], 0, 50, '...') . "</td>
					<td>{$row['gender']}</td>
					<td>" . mb_strimwidth($row['ip_address'], 0, 50, '...') . "</td>
				</tr>";
		}
		
		$total = $stmt->rowCount(); // Obtendo o total de registros contidos no fetch
		echo "<tr><td colspan='7'><strong>Total de Customers: {$total}</strong></td></tr>";
	} else {
		echo "<tr><td colspan='7'>Houve um problema na execução do SQL.</td></tr>";
	}