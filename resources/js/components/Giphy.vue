<template>
  <section class="container">
    <div class="columns">
      <form @submit="giphySearch" class="column is-one-fifth" action="#" method="GET">
        <div class="field">
          <label class="label" for="giphy-search">Search</label>
          <div class="control">
            <input v-model="searchTerm" class="input" type="text" name="giphy-search" placeholder="Enter search term...">
          </div>
        </div>
        <div class="field is-grouped">
          <div class="control">
            <button type="submit" class="button is-link">Submit</button>
          </div>
        </div>
      </form>
      <div class="column is-four-fifths">
        <ul class="columns is-multiline">
          <li
            v-for="image in results.data"
            :key="image.id"
            class="column is-one-quarter">
            <img
              :src="image.images.fixed_width.url"
              :alt="image.title"
              :title="image.title"
              @click="getImageUrl">
          </li>
        </ul>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'Giphy',
  data ()
  {
    return {
      searchTerm: '',
      results: {}
    }
  },
  methods: {
    giphySearch ( event )
    { // Prevent form from submitting.
      event.preventDefault();
      // Pull data from the GIPHY API.
      fetch( 'https://api.giphy.com/v1/gifs/search?api_key=OtaQGtho3WD9yhs2eyYr1I9cibHLr6ay&limit=25&offset=0&rating=G&lang=en&q='+this.searchTerm )
        .then( response => response.json() ) // Convert to JS object.
        .then( data => { // Store the returned data in our "results."
          this.results = data;
        } );
    },
    getImageUrl ( event )
    {
      const img = event.target;
      console.log( img.src );
      // Bubble upward an "imageClicked" event with the image's source.
      this.$emit( 'image-clicked', img.src );
    }
  }
}
</script>

<style>
</style>
