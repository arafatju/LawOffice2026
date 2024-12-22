
@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
 
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __(' অবমুক্তি     ') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('reason111') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="reason" class="col-md-4 col-form-label text-md-end">{{ __('অবমুক্তির কারণ  অনধিক ৩০ শব্দ ') }}</label>

                            <textarea 
                            id="reason" 
                            rows="4" 
                            cols="30" 
                            class="form-control @error('reason') is-invalid @enderror" 
                            name="reason" 
                            required 
                            autocomplete="reason" 
                            autofocus 
                            oninput="updateWordCount(this, 29)">
                        </textarea>
                        <div class="d-flex justify-content-end">
                        <div id="wordCount" class="mt-2 fs-6">Word count: 0 / 30</div>
                        </div> 
                        @error('reason')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                        <div class="row mb-3">
                            <label for="five" class="col-md-4 col-form-label text-md-end">{{ __('পছন্দের জেলা (সর্বোচ্চ ৫ জেলা ) ') }}</label>

                             
                                <input id="five" type="text" class="form-control @error('five') is-invalid @enderror" name="five"  oninput="update11WordCount(this, 5)"   required autocomplete="five" autofocus>
                                <div class="d-flex justify-content-end">
                                    <div id="wordCount11" class="mt-2 fs-6">District count: 0 / 5</div>
                                    </div> 
                                @error('five')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
                        
                        
                       
                        
                         
                         
                         

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save & Submit ') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


       
    </div> 

    

</div>

 
</div>    
<script>
    // Function to update the word count and ensure it does not exceed maxWords
    function updateWordCount(textarea, maxWords) {
        let text = textarea.value.trim();
        let words = text.split(/\s+/); // Split the input by spaces to count words

        // Update word count display
        let wordCount = words.length;
        if (text === "") {
            wordCount = 0;
        }

        // Display the current word count and limit it
        document.getElementById("wordCount").textContent = "Word count: " + wordCount + " / " + maxWords;

        // If word count exceeds the maxWords, trim the textarea input
        if (wordCount > maxWords) {
            words = words.slice(0, maxWords);
            textarea.value = words.join(" "); // Update textarea content
            textarea.setAttribute("readonly", true); // Make textarea readonly
        } else {
            textarea.removeAttribute("readonly"); // Remove readonly if word count is within limit
        }
    }
    function update11WordCount(textarea, maxWords) {
        let text = textarea.value.trim();
let words = text.split(/[,\s]+/);

        // Remove empty strings from the array (caused by multiple spaces or commas)
        words = words.filter(word => word.length > 0);

// Get the count of valid words
let wordCount = words.length;

// Update the word count display
 
        // Display the current word count and limit it
        document.getElementById("wordCount11").textContent = "Word count: " + wordCount + " / " + maxWords;

        // If word count exceeds the maxWords, trim the textarea input
        if (wordCount > maxWords) {
            words = words.slice(0, maxWords);
            textarea.value = words.join(" "); // Update textarea content
            textarea.setAttribute("readonly", true); // Make textarea readonly
        } else {
            textarea.removeAttribute("readonly"); // Remove readonly if word count is within limit
        }
    }
</script>  
@endsection








 










 
