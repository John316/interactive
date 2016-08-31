<div class="main">
  <h1>Home page</h1>
  <div class="status">
    <p>
      Place for status graph.
    </p>
    <div id="understandChart">
    </div>
  </div>
  <div class="tools">
    <form class="main_tools" action="index.php?url=level" method="post">
      <label for="undestand">Undestand level</label>
      <input type="number" name="level1" id="level1" value="0">

      <label for="agree">Agree level</label>
      <input type="number" name="level2" id="level2" value="0">
      <input type="button" name="name" id="sendLevel" value="Send">

      <input type="hidden" name="level3" value="0">
    </form>
    <input type="button" name="name" id="start" value="Start">
    <input type="button" name="name" id="stop" value="Stop">
  </div>
</div>
