<?php
class Energies
{
    private string $energie;
    private int $Id_Energies;

    private function GetEnergie()
    {
        return $this->energie;
    }
    private function GetId_Energies()
    {
        return $this->Id_Energies;
    }
    private function SetEnergie($energie)
    {
        $this->energie = $energie;
    }
    private function SetId_Energies($Id_Energies)
    {
        $this->Id_Energies = $Id_Energies;
    }
    public function __construct($energie, $Id_Energies)
    {
        $this->SetEnergie($energie);
        $this->SetId_Energies($Id_Energies);
    }
}