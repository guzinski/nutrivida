<?php

namespace Nutrivida\LojaBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Description of ProdutoRepository
 *
 * @author Luciano
 */
class ProdutoRepository extends EntityRepository
{
    public function getProdutoAtivos($idCategoria = null, $destaque = null, $order = null, $limit = null, $offset = null)
    {
        $query = $this->createQueryBuilder("P")
                    ->andWhere("P.ativo = 1");
        if ($idCategoria != null) {
            $query->andWhere("P.categoria = :id");
            $query->setParameter("id", $idCategoria);
        }
        if ($destaque != null) {
            $query->andWhere("P.destaqueCategoria = :destaque");
            $query->setParameter("destaque", $destaque);
        }
        if ($order != null) {
            if ($order=='nome') {
                $query->orderBy("P.nome");
            } elseif ($order=='valor') {
                $query->orderBy("P.valor");
            } 
        } else {
            $query->orderBy("P.nome");
        }
        
        if (($limit+$offset)>0) {
            $query->setMaxResults($limit);
            $query->setFirstResult($offset);
        }
        
        return $query->getQuery()->getResult();
    }
    
    public function getProdutosComDesconto()
    {
        $query = $this->createQueryBuilder("P")
                    ->andWhere("P.ativo = 1")
                    ->andWhere("P.desconto = 1")
                    ->setMaxResults(4)
                    ->setFirstResult(0);
        
        return $query->getQuery()->getResult();
    }
    
    public function countProdutoAtivos($idCategoria = null, $destaque = null)
    {
        $query = $this->createQueryBuilder("P");
        $query->select($query->expr()->count("P"))
                    ->andWhere("P.ativo = 1");
        if ($idCategoria != null) {
            $query->andWhere("P.categoria = :id");
            $query->setParameter("id", $idCategoria);
        }
        if ($destaque != null) {
            $query->andWhere("P.destaqueCategoria = :destaque");
            $query->setParameter("destaque", $destaque);
        }
        
        return $query->getQuery()->getSingleScalarResult();
    }
    
    /* 
     * @param type $idCategoria
     * @return type
     */
    public function getProdutosDestaques()
    {
        $query = $this->createQueryBuilder("P")
                    ->andWhere("P.destaqueCategoria = 1")
                    ->andWhere("P.ativo = 1");
        
        return $query->getQuery()->getResult();
    }


}
