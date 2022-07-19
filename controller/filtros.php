<?php
	// IMPORTAÇÃO DA CONEXÃO COM O BANCO DE DADOS
	require_once '../model/db_connect.php';

	// CONEXÃO COM O BANCO
	$conn = dbConnect();
	
	// VALIDAÇÃO DA CONEXÃO
	if (!is_object($conn)) {
		echo "<p>Houve um problema de conexão com o banco: {$conn}</p>";
		exit;
	}

	// SQLs
	//SQL PARA SELECIONAR OS CUSTOMERS SEM SOBRENOME
	$sql_sem_sobrenome = "SELECT * FROM customers WHERE last_name = ''";
	$stmt_sem_sobrenome = $conn->prepare($sql_sem_sobrenome);

	//SQL PARA SELECIONAR OS CUSTOMERS COM SOBRENOME
	$sql_com_sobrenome = "SELECT * FROM customers WHERE last_name != ''";
	$stmt_com_sobrenome = $conn->prepare($sql_com_sobrenome);

	//SQL PARA SELECIONAR OS CUSTOMERS SEM GENERO
	$sql_sem_genero = "SELECT * FROM customers WHERE gender = ''";
	$stmt_sem_genero = $conn->prepare($sql_sem_genero);

	//SQL PARA SELECIONAR OS CUSTOMERS COM GENERO
	$sql_com_genero = "SELECT * FROM customers WHERE gender != ''";
	$stmt_com_genero = $conn->prepare($sql_com_genero);

	//SELECIONAR EMAIL VALIDOS
	$sql_email_valido = "SELECT * FROM customers WHERE email NOT REGEXP '^[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9._-]@[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9].[a-zA-Z]{2,63}$'";
	$stmt_email_valido = $conn->prepare($sql_email_valido);

	//SELECIONAR TOTAL CAD
	$sql_total = "SELECT * FROM customers";
	$stmt_total = $conn->prepare($sql_total);

	//CONTANDO TOTAL
	if ($stmt_total->execute()){
		$rs = $stmt_total->fetchAll(PDO::FETCH_ASSOC);
		$total = $stmt_total->rowCount();
	}

	//EXECUTANDO E CONTANDO OS CUSTOMERS SEM SOBRENOME
	if ($stmt_sem_sobrenome->execute()) {
		$rs = $stmt_sem_sobrenome->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rs as $row) {		
		$total_sem_sbrenome = $stmt_sem_sobrenome->rowCount();
	} 
		echo "<p><strong>Total de Customers sem sobrenome: {$total_sem_sbrenome}</strong></p>";
	} else {
		echo "<p>Houve um problema na execução do SQL.</p>";
	}

	//EXECUTANDO E CONTANDO OS CUSTOMERS COM SOBRENOME
	if ($stmt_com_sobrenome->execute()) {
		$rs = $stmt_com_sobrenome->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rs as $row) {		
		$total_com_sobrenome = $stmt_com_sobrenome->rowCount();
	} 
		echo "<p><strong>Total de Customers com sobrenome: {$total_com_sobrenome}</strong></p>";
	} else {
		echo "<p>Houve um problema na execução do SQL.</p>";
	}

	//EXECUTANDO E CONTANDO OS CUSTOMERS SEM GENERO
	if ($stmt_sem_genero->execute()) {
		$rs = $stmt_sem_genero->fetchAll(PDO::FETCH_ASSOC);
		$total_sem_genero = $stmt_sem_genero	->rowCount(); 
		echo "<p><strong>Total de Customers sem gênero: {$total_sem_genero}</strong></p>";
	} else {
		echo "<p>Houve um problema na execução do SQL.</p>";
	}

	//EXECUTANDO E CONTANDO OS CUSTOMERS COM GENERO
	if ($stmt_com_genero->execute()) {
		$rs = $stmt_com_genero->fetchAll(PDO::FETCH_ASSOC);
		$total_com_genero = $stmt_com_genero->rowCount(); 
		echo "<p><strong>Total de Customers com gênero: {$total_com_genero}</strong></p>";
	} else {
		echo "<p>Houve um problema na execução do SQL.</p>";
	}

	//EXECUTANDO E CONTANDO OS CUSTOMERS COM EMAIL VÁLIDO E INVÁLIDO
	if ($stmt_email_valido->execute()) {
		$rs = $stmt_email_valido->fetchAll(PDO::FETCH_ASSOC);
		$total_valido = $stmt_email_valido->rowCount(); 
		$total_invalido = $total - $total_valido;
		echo "<p><strong>Total de Customers com e-mail válido: {$total_valido}</strong></p>
		      <p><strong>Total de Customers com e-mail inválido: {$total_invalido}</strong></p>";
	} else {
		echo "<p>Houve um problema na execução do SQL.</p>";
	}