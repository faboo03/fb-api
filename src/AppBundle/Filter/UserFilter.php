<?php
namespace AppBundle\Filter;

use AppBundle\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Dunglas\ApiBundle\Api\ResourceInterface;
use Dunglas\ApiBundle\Doctrine\Orm\Filter\AbstractFilter;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authentication\Token\JWTUserToken;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserFilter extends AbstractFilter
{
    /**
     *
     * @var TokenInterface
     */
    private $token = null;

    public function __construct(TokenStorageInterface $token, ManagerRegistry $managerRegistry, array $properties = null)
    {
        $this->token = $token->getToken();
        $this->managerRegistry = $managerRegistry;
        $this->properties = $properties;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(ResourceInterface $resource, QueryBuilder $queryBuilder, Request $request)
    {
        if($this->token->getUser() instanceof User) {
            $queryBuilder
                ->andWhere('o.user = :user')
                ->setParameter("user", $this->token->getUser());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription(ResourceInterface $resource)
    {
        $description = [];
        $metadata = $this->getClassMetadata($resource);

        foreach ($metadata->getFieldNames() as $fieldName) {
            if ($this->isPropertyEnabled($fieldName)) {
                $description[$fieldName] = [
                    'property' => $fieldName,
                    'type' => 'string',
                    'required' => false,
                ];
            }
        }

        return $description;
    }
}