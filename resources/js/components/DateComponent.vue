<template>
    <div class="container">
        <div class="border-2 rounded-full border-gray-500 flex-auto text-white text-center bg-gray-900 px-4 py-2 m-2">
           <p> {{__('all.Start of the next match')}} <span class="font-bold">{{ getFormat() }} </span></p> 
        </div>
    </div>
</template>

<script>

import { format, formatDistance, formatDistanceStrict, formatDistanceToNow, formatRelative } from 'date-fns'
import { es, fr, enGB } from 'date-fns/locale'
import { zonedTimeToUtc, utcToZonedTime } from 'date-fns-tz'

export default {
  data () {
    return {
      formatDistanceToNow,
    }
  },

  methods: {
    getFormat () {
      return this.formatDistanceToNow(new Date(2020, 1, 26, 17, 0, 0),  
                        { includeSeconds: true,                          
                          locale: fr, 
                          addSuffix: true })                                        
    } 
  }
}
</script>
