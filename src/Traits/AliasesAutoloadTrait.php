<?php


namespace AlexLathwell\Jetpack\Traits;


use Illuminate\Foundation\AliasLoader;

trait AliasesAutoloadTrait
{

    private function loadAlias($aliasKey, $aliasValue)
    {
        AliasLoader::getInstance()->alias($aliasKey, $aliasValue);
    }

    public function loadAliases()
    {
        if(isset($this->aliases)){
            foreach ($this->aliases as $aliasKey => $aliasValue) {
                $this->loadAlias($aliasKey, $aliasValue);
            }
        }
    }
}