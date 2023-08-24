<?php
class Energies
{
    protected string $energie;
    protected int $Id_Energies;

    protected function GetEnergie()
    {
        return $this->energie;
    }
    protected function GetId_Energies()
    {
        return $this->Id_Energies;
    }
    protected function SetEnergie($energie)
    {
        $this->energie = $energie;
    }
    protected function SetId_Energies($Id_Energies)
    {
        $this->Id_Energies = $Id_Energies;
    }
    public function __construct($energie, $Id_Energies)
    {
        $this->SetEnergie($energie);
        $this->SetId_Energies($Id_Energies);
    }
}