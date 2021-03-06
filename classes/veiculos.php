<?php 

require_once 'db.php';

class veiculos extends db {

	protected $tabela = 'veiculos';


	public function findAll() {
			$sql = "SELECT * FROM $this->tabela";
			$stm = db::prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

	public function findAllAlvara() {
			$sql = "SELECT * FROM $this->tabela ORDER BY alvara DESC";
			$stm = db::prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

	public function findAllProprietarios() {
			$sql = "SELECT * FROM $this->tabela GROUP BY proprietario";
			$stm = db::prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

	public function findAllAutorizacao() {
			$sql = "SELECT * FROM $this->tabela ORDER BY autorizacao DESC";
			$stm = db::prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

	public function findAutorizacao($inicio,$fim) {
			$sql = "SELECT * FROM $this->tabela WHERE autorizacao BETWEEN :inicio AND :fim";
			$stm = db::prepare($sql);
			$stm->bindparam(":inicio",$inicio);
			$stm->bindparam(":fim",$fim);
			$stm->execute();
			return $stm->fetchAll();
		}


	public function findValidade30($trintaDias,$agora) {
			$sql = "SELECT * FROM $this->tabela WHERE tacografo BETWEEN :agora AND :trintaDias";
			$stm = db::prepare($sql);
			$stm->bindparam(":trintaDias",$trintaDias);
			$stm->bindparam(":agora",$agora);
			$stm->execute();
			return $stm->fetchAll();
		}


	public function findCOD($codigo) {
			$sql = "SELECT * FROM $this->tabela WHERE codigo=:codigo";
			$stm = db::prepare($sql);
			$stm->bindparam(":codigo",$codigo);
			$stm->execute();
			return $stm->fetch();
		}


	public function findVeiculo($idVeiculo) {
			$sql = "SELECT * FROM $this->tabela WHERE id=:idVeiculo";
			$stm = db::prepare($sql);
			$stm->bindparam(":idVeiculo",$idVeiculo);
			$stm->execute();
			return $stm->fetch();
		}


	public function findFinalPlaca($placa) {
			$sql = "SELECT * FROM $this->tabela WHERE RIGHT(placa,1) = :placa";
			$stm = db::prepare($sql);
			$stm->bindparam(":placa",$placa);
			$stm->execute();
			return $stm->fetchAll();
		}


	public function findAlvaraMes($mesAtual) {
			$sql = "SELECT * FROM $this->tabela WHERE alvara = 1 AND SUBSTRING(alvara, 4, 2) =:mes ORDER BY alvara DESC";
			$stm = db::prepare($sql);
			$stm->bindparam(":mes",$mesAtual);
			$stm->execute();
			return $stm->fetchAll();
		}


	public function getID($id)
		{
			$sql = "SELECT * FROM $this->tabela WHERE id=:id";
			$stm = db::prepare($sql);
			$stm->bindparam(":id",$id);
			$stm->execute();
			return $stm->fetch();
		}


	public function findID($AssId)
		{
			$sql = "SELECT * FROM $this->tabela WHERE nr_associado=:id";
			$stm = db::prepare($sql);
			$stm->bindparam(":id",$AssId);
			$stm->execute();
			return $stm->fetch();
		}

	
	public function delID($id)
		{
			$sql = "DELETE FROM $this->tabela WHERE id=:id";
			$stmt = db::prepare($sql);
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			return true;
		}

	public function foto($codigo,$mini,$img)
	{
		try
		{

			$sql 	= "UPDATE $this->tabela SET 
			foto	=:img, 
			thumb	=:mini
			WHERE
			id		=:id";
			$stmt = db::prepare($sql);
			$stmt->bindparam(":id",$codigo);
			$stmt->bindparam(":img",$img);
			$stmt->bindparam(":mini",$mini);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
		
	}	



public function cadastro($nr_associado,$prefixo,$placa,$marca,$modelo,$renavam,$chassi,$cap,$cor,$ano_fab,$ano_mod,$prefeitura,$alvara,$autorizacao,$tacografo,$inmetro,$proprietario)
	{
		try
		{
			
			$sql = "INSERT INTO $this->tabela (nr_associado,prefixo,placa,marca,modelo,renavam,chassi,cap,cor,ano_fab,ano_mod,prefeitura,alvara,autorizacao,tacografo,inmetro,proprietario) VALUES(:nr_associado, :prefixo, :placa, :marca, :modelo, :renavam, :chassi, :cap, :cor, :ano_fab, :ano_mod, :prefeitura, :alvara, :autorizacao, :tacografo, :inmetro, :proprietario)";
			$stmt = db::prepare($sql);
			$stmt->bindparam(":nr_associado",$nr_associado);
			$stmt->bindparam(":prefixo",$prefixo);
			$stmt->bindparam(":placa",$placa);
			$stmt->bindparam(":marca",$marca);
			$stmt->bindparam(":modelo",$modelo);
			$stmt->bindparam(":renavam",$renavam);
			$stmt->bindparam(":chassi",$chassi);
			$stmt->bindparam(":cap",$cap);
			$stmt->bindparam(":cor",$cor);
			$stmt->bindparam(":ano_fab",$ano_fab);
			$stmt->bindparam(":ano_mod",$ano_mod);
			$stmt->bindparam(":prefeitura",$prefeitura);
			$stmt->bindparam(":alvara",$alvara);
			$stmt->bindparam(":autorizacao",$autorizacao);
			$stmt->bindparam(":tacografo",$tacografo);
			$stmt->bindparam(":inmetro",$inmetro);
			$stmt->bindparam(":proprietario",$proprietario);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
		
	}	



public function importar($nr_associado,$prefixo,$placa,$marca,$modelo,$renavam,$chassi,$cap,$cor,$ano_fab,$ano_mod,$prefeitura,$alvara,$autorizacao,$tacografo,$inmetro,$proprietario)
	{
		try
		{
			
			$sql = "INSERT INTO $this->tabela (nr_associado,prefixo,placa,marca,modelo,renavam,chassi,cap,cor,ano_fab,ano_mod,prefeitura,alvara,autorizacao,tacografo,inmetro,proprietario) VALUES(:nr_associado, :prefixo, :placa, :marca, :modelo, :renavam, :chassi, :cap, :cor, :ano_fab, :ano_mod, :prefeitura, :alvara, :autorizacao, :tacografo, :inmetro, :proprietario)";
			$stmt = db::prepare($sql);
			$stmt->bindparam(":nr_associado",$nr_associado);
			$stmt->bindparam(":prefixo",$prefixo);
			$stmt->bindparam(":placa",$placa);
			$stmt->bindparam(":marca",$marca);
			$stmt->bindparam(":modelo",$modelo);
			$stmt->bindparam(":renavam",$renavam);
			$stmt->bindparam(":chassi",$chassi);
			$stmt->bindparam(":cap",$cap);
			$stmt->bindparam(":cor",$cor);
			$stmt->bindparam(":ano_fab",$ano_fab);
			$stmt->bindparam(":ano_mod",$ano_mod);
			$stmt->bindparam(":prefeitura",$prefeitura);
			$stmt->bindparam(":alvara",$alvara);
			$stmt->bindparam(":autorizacao",$autorizacao);
			$stmt->bindparam(":tacografo",$tacografo);
			$stmt->bindparam(":inmetro",$inmetro);
			$stmt->bindparam(":proprietario",$proprietario);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
		
	}	


	public function editar($a_id,$nr_associado,$prefixo,$placa,$marca,$modelo,$renavam,$chassi,$cap,$cor,$ano_fab,$ano_mod,$prefeitura,$alvara,$autorizacao,$tacografo,$inmetro,$proprietario)
	{
		try
		{

			$sql = "UPDATE $this->tabela SET
			nr_associado 		=:nr_associado, 
			prefixo				=:prefixo,
			placa				=:placa,
			marca				=:marca,
			modelo				=:modelo,
			renavam				=:renavam,
			chassi				=:chassi,
			cap					=:cap,
			cor					=:cor,
			ano_fab				=:ano_fab,
			ano_mod				=:ano_mod, 
			prefeitura			=:prefeitura, 
			alvara				=:alvara,
			autorizacao			=:autorizacao,
			tacografo			=:tacografo,
			inmetro				=:inmetro,
			proprietario		=:proprietario
			WHERE 
			id					=:a_id";

			$stmt = db::prepare($sql);
			$stmt->bindparam(":a_id",$a_id);
			$stmt->bindparam(":nr_associado",$nr_associado);
			$stmt->bindparam(":prefixo",$prefixo);
			$stmt->bindparam(":placa",$placa);
			$stmt->bindparam(":marca",$marca);
			$stmt->bindparam(":modelo",$modelo);
			$stmt->bindparam(":renavam",$renavam);
			$stmt->bindparam(":chassi",$chassi);
			$stmt->bindparam(":cap",$cap);
			$stmt->bindparam(":cor",$cor);
			$stmt->bindparam(":ano_fab",$ano_fab);
			$stmt->bindparam(":ano_mod",$ano_mod);
			$stmt->bindparam(":prefeitura",$prefeitura);
			$stmt->bindparam(":alvara",$alvara);
			$stmt->bindparam(":autorizacao",$autorizacao);
			$stmt->bindparam(":tacografo",$tacografo);
			$stmt->bindparam(":inmetro",$inmetro);
			$stmt->bindparam(":proprietario",$proprietario);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
		
	}


	
}



 ?>