<?php

namespace Drupal\graphql_persistent\Plugin\GraphQL\InputTypes;

use Drupal\graphql\Plugin\GraphQL\InputTypes\InputTypePluginBase;

/**
 * The input type for chapter mutations.
 *
 * @GraphQLInputType(
 *   id = "chapter_input",
 *   name = "ChapterInput",
 *   fields = {
 *     "title" = "String",
 *   }
 * )
 */
class ChapterInput extends InputTypePluginBase {

}
