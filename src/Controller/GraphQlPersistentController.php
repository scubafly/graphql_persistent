<?php

namespace Drupal\graphql_persistent\Controller;

use Drupal\graphql_persistent\Execution\GraphQlQueryProcessor;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\graphql\GraphQL\Execution\QueryProcessor;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class GraphQlPersistentController.
 *
 * @package Drupal\graphql_persistent\Controller
 */
class GraphQlPersistentController implements ContainerInjectionInterface {

  /**
   * The service configuration parameters.
   *
   * @var array
   */
  protected $parameters;

  /**
   * GraphQlQueryProcessor instance.
   *
   * @var \Drupal\graphql_persistent\Execution\GraphQlQueryProcessor
   */
  protected $graphQlQueryProcessor;

  /**
   * GraphQlPersistentController constructor.
   */
  public function __construct(QueryProcessor $processor) {
    $this->graphQlQueryProcessor = new GraphQlQueryProcessor($processor);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('graphql.query_processor'),
      $container->getParameter('graphql.config')
    );
  }

  /**
   * User call.
   *
   * @return JsonResponse
   *   JSON object.
   */
  public function getUser() {
    return $this->graphQlQueryProcessor->processQueryFromFile('user.gql');
  }

}
