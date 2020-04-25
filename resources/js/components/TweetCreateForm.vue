<template>
  <form :action="submissionUrl" method="post">
    <slot></slot>
    <div v-if="isGif" class="row">
      <div class="col-md-12">
        <img :src="message">
        <button class="btn btn-warning" @click="resetMessage">Reset</button>
        <input type="hidden" name="message" v-model="message">
        <input type="hidden" name="is_gif" :value="isGif">
      </div>
    </div>
    <div v-else class="row">
      <div class="col-md-12">
        <div class="form-group">
          <strong>Message</strong>
          <textarea name="message" v-model="message"></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <input class="btn btn-primary" type="submit" value="Create">
      </div>
    </div>
  </form>
</template>

<script>
  export default {
    name: 'tweet-create-form',
    props: [ 'submissionUrl' ],
    computed: {
      message: {
        get()
        {
          // Check if it is a GIF URL, or a regular message.
          // Updates our this.isGif data in storage.
          this.isStringAGIFUrl( this.$attrs.value );
          return this.$attrs.value;
        },
        set( value )
        {
          this.$emit( 'input', value );
        }
      }
    },
    methods: {
      isStringAGIFUrl ( string )
      {
        if ( string.includes( 'http' ) && string.includes( '.gif' ) )
        {
          this.isGif = true;
          return true;
        }
        this.isGif = false;
        return false;
      },
      resetMessage ()
      {
        this.message = '';
      }
    },
    data ()
    {
      return {
        isGif: false
      }
    }
  }
</script>