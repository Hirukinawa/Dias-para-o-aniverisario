<?php

class Pessoa {

    private $nome;
    private $dataNascimento;
    private $idade;
    private $diasProximoAniversario;

    public function __construct() {
        
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function getIdade() {
        return $this->idade;
    }

    public function getDiasProximoAniversario() {
        return $this->diasProximoAniversario;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setDataNascimento($dataNascimento): void {
        $this->dataNascimento = $dataNascimento;
    }

    public function setIdade($idade): void {
        $this->idade = $idade;
    }

    public function setDiasProximoAniversario($diasProximoAniversario): void {
        $this->diasProximoAniversario = $diasProximoAniversario;
    }

    public function calculaIdade($birthDate) {

        $birthDay = date('d', $birthDate); // Dia do nascimento
        $birthMonth = date('m', $birthDate); // Mês do nascimento
        $birthYear = date('Y', $birthDate); // Ano do nascimento

        $currentDay = date('d'); // Dia atual
        $currentMonth = date('m'); // Mês atual
        $currentYear = date('Y'); // Ano atual
        
        // Data de nascimento tipo DateTime
        $birthDateTime = new DateTime(date($birthYear . $birthMonth . $birthDay));

        // Data do aniversário do ano atual tipo DateTime
        $nextBirthday = new DateTime(date($currentYear . $birthMonth . $birthDay));

        // Pega a diferença de anos entre a data de nascimento e a data de aniversário do ano atual
        $yearsDifference = $birthDateTime->diff($nextBirthday);

        // Checa se a pessoa ainda vai fazer aniversário esse ano
        if ($currentMonth < $nextBirthday->format('m')) {

            $age = (int) $yearsDifference->y - 1;
            $this->setIdade($age);
            
        } else if ($currentMonth == $nextBirthday->format('m') && $currentDay < $nextBirthday->format('d')) {

            $age = (int) $yearsDifference->y - 1;
            $this->setIdade($age);
            
        } else {

            $age = (int) $yearsDifference->y;
            $this->setIdade($age);
            
        }
    }

    public function calculaDias($birthDate) {

        $birthDay = date('d', $birthDate); // Dia do nascimento
        $birthMonth = date('m', $birthDate); // Mês do nascimento

        $currentDay = date('d'); // Dia atual
        $currentMonth = date('m'); // Mês atual
        $currentYear = date('Y'); // Ano atual
        
        // Data do aniversário do ano atual tipo DateTime
        $nextBirthday = new DateTime(date($currentYear . $birthMonth . $birthDay));

        if ($currentMonth > $nextBirthday->format('m')) {

            // Se já fez, o próximo aniversário é setado como no próximo ano
            (int) $currentYear += 1;
            
        } else if ($currentMonth == $nextBirthday->format('m') && $currentDay > $nextBirthday->format('d')) {
            
            // Se já fez, o próximo aniversário é setado como no próximo ano
            (int) $currentYear += 1;
            
        }

        $currentDate = date('Ymd');
        $birthdayDate = date($currentYear . $birthMonth . $birthDay);

        // Calcula a diferença em segundos entre as datas
        $difference = strtotime($currentDate) - strtotime($birthdayDate);

        //Calcula a diferença em dias
        $days = floor($difference / (24 * 60 * 60));

        $positiveDays = $days - ($days * 2);

        $this->setDiasProximoAniversario($positiveDays);
    }

}
