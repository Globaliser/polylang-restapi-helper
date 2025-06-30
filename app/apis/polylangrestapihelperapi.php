<?php

namespace PolylangRestapiHelper;

use \Exception;

class PolylangRestapiHelperApi extends Api
{

  function __construct()
  {
    parent::__construct();
  }

  public function api_set_post_lang_relation($request)
  {
      try {
          $translations = $request->get_param('translations');

          if (empty($translations) || !is_array($translations)) {
              return $this->send_error('The "translations" parameter must be a non-empty object.', [], 400);
          }
          $functionOutput = pll_save_post_translations($translations);
          return $this->send_success(
              'Post language relations saved successfully.',
              ['translations' => $functionOutput]
          );
          
      } catch (Exception $e) {
          return $this->apiException($e);
      }
  }

    public function api_set_category_lang_relation($request)
    {
        try {
            $translations = $request->get_param('translations');
            if (empty($translations) || !is_array($translations)) {
                return $this->send_error('The "translations" parameter must be a non-empty object.', [], 400);
            }
            $functionOutput = pll_save_term_translations($translations);

            return $this->send_success(
                'Category language relations saved successfully.',
                ['translations' => $functionOutput]
            );
        } catch (Exception $e) {
            return $this->apiException($e);
        }
    }

  public function api_get_post_lang_relations($request)
  {
      try {
          $post_id = (int) $request->get_param('id');
          if ($post_id <= 0) {
              return $this->send_error('A valid post ID is required.', [], 400);
          }
          if (!get_post_status($post_id)) {
              return $this->send_error('Post not found.', [], 404);
          }
          $translations = pll_get_post_translations($post_id);
          if (empty($translations)) {
              return $this->send_success(
                  'No translations found for this post.',
                  ['translations' => (object)[]]
              );
          }
          return $this->send_success(
              'Translations retrieved successfully.',
              ['translations' => $translations]
          );
      } catch (Exception $e) {
          return $this->apiException($e);
      }
  }

    public function api_get_category_lang_relations($request)
    {
        try {
            $category_id = (int) $request->get_param('id');

            if ($category_id <= 0) {
                return $this->send_error('A valid category ID is required.', [], 400);
            }

            // Check if the term exists for the 'category' taxonomy
            if (!get_term($category_id, 'category')) {
                return $this->send_error('Category not found.', [], 404);
            }
            
            // Use Polylang function to get all translations for the term ID
            $translations = pll_get_term_translations($category_id);

            if (empty($translations)) {
                return $this->send_success(
                    'No translations found for this category.',
                    ['translations' => (object)[]]
                );
            }

            return $this->send_success(
                'Category translations retrieved successfully.',
                ['translations' => $translations]
            );

        } catch (Exception $e) {
            return $this->apiException($e);
        }
    }

}
