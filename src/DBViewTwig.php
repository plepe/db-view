<?php
class DBViewTwig extends DBView {
  function show () {
    foreach ($this->get() as $entry) {
      $data = array(
        'entry' => $entry
      );

      yield twig_render_custom($this->def, $data);
    }
  }
}

