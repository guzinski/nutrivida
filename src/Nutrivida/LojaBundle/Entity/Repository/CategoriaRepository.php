<?php
namespace Nutrivida\LojaBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of CategoriaRepository
 *
 * @author Luciano
 */
class CategoriaRepository extends EntityRepository
{
    
    /**
     * 
     * @param type $idCategoria
     * @return type
     */
    public function getProdutosDestaques($idCategoria = null)
    {
        $query = $this->createQueryBuilder("C")
                    ->leftJoin("C.produtos", "P")
                    ->andWhere("P.destaqueCategoria = 1")
                    ->andWhere("P.ativo = 1");
        if ($idCategoria != null) {
            $query->andWhere("C.id = :id");
            $query->setParameter("id", $idCategoria);
        }
        
        return $query->getQuery()->getResult();
    }
    
    
    
}
