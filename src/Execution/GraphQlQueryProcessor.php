<?php

namespace Drupal\graphql_persistent\Execution;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use GraphQL\Server\OperationParams;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\graphql_persistent\Traits\QueryFileTrait;
use Drupal\graphql\GraphQL\Execution\QueryProcessor;

/**
 * Class GraphQlQueryProcessor.
 */
class GraphQlQueryProcessor implements ContainerInjectionInterface {
  use QueryFileTrait;

  /**
   * The query processor.
   *
   * @var \Drupal\graphql\GraphQL\Execution\QueryProcessor
   */
  protected $processor;

  /**
   * The service configuration parameters.
   *
   * @var array
   */
  protected $parameters;

  /**
   * Http headers for all results.
   *
   * @var array
   */
  protected $headers;

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
   * GraphQlQueryProcessor constructor.
   *
   * @param \Drupal\graphql\GraphQL\Execution\QueryProcessor $processor
   *   The query processor.
   * @param array $headers
   *   Allow to add more headers, or overwrite current headers.
   */
  public function __construct(QueryProcessor $processor, $headers = []) {
    $this->processor = $processor;

    $class_headers = [
      'Content-Type' => 'application/json',
      'Access-Control-Allow-Origin' => '*',
    ];
    $this->headers = array_merge($class_headers, $headers);
  }



  /**
   * Process a .gql file and return a json object.
   *
   * @param string $filename
   *   The name of the .gql file, placed in the queries folder of this module.
   *
   * @return JsonResponse
   *   JSON object.
   */
  public function processQueryFromFile($filename) {
    $query = $this->getQueryFromFile($filename);
    $operation = OperationParams::create(['query' => $query]);
    // For now use the default:default plugin.
    $result = $this->processor->processQuery('default:default', $operation);
    // TODO handle errors, wrong calls, and or cover by test coverage.
    return new JsonResponse($result->data, 200, $this->headers, FALSE);
  }

}
