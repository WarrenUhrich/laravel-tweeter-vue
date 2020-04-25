<template>
  <form :action="submissionUrl" method="post">
    <slot></slot>
    <div class="row">
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
          return this.$attrs.value;
        },
        set( value )
        {
          this.$emit( 'input', value );
        }
      }
    }
  }
</script>