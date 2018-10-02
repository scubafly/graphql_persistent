<?php

namespace Drupal\graphql_persistent\Plugin\GraphQL\Mutations;

use Drupal\graphql\GraphQL\Execution\ResolveContext;
use Drupal\graphql_core\Plugin\GraphQL\Mutations\Entity\UpdateEntityBase;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Simple mutation for updating an existing chapter node.
 *
 * @GraphQLMutation(
 *   id = "update_chapter",
 *   entity_type = "node",
 *   entity_bundle = "chapter",
 *   secure = true,
 *   name = "updateChapter",
 *   type = "EntityCrudOutput",
 *   arguments = {
 *      "id" = "String",
 *      "input" = "ChapterInput"
 *   }
 * )
 */
class UpdateChapter extends UpdateEntityBase {

  /**
   * {@inheritdoc}
   */
  protected function extractEntityInput(
    $value,
    array $args,
    ResolveContext $context,
    ResolveInfo $info
  ) {
    return array_filter([
      'title' => $args['input']['title'],
    ]);
  }

}
