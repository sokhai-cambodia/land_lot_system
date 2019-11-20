@extends('layouts.cms.template', compact('title'))

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">ព្រះរាជាណាចក្រកម្ពុជា</h3>
                <h3 class="text-center">ជាតិសាសនា ព្រះមហាក្សត្រ</h3>                    
            </div>
            <div class="col-md-12">
                <p class="text-center"><u>លិខិតប្រគល់ប្លង់ដី និងបង់ប្រាក់បង្រ្គប់</u></p>
                <p>
                    - :name:	បានទទួលប្លង់ដីដែលមានលេខឡូតិ៍ :land: តម្លៃសរុបចំនួន:price: ។
                </p>  
                <p>
                    - បានកក់ប្រាក់នៅថ្ងៃទី :date: ចំនួន :price:
                </p>  
                <p>
                    - បានបង់ប្រាក់បង្គ្រប់នៅថ្ងៃទី :date: ចំនួន :price:។
                </p>    
                <p class="text-right">ធ្វើនៅថ្ងៃទី០៦ ខែកញ្ញា ឆ្នាំ២០១៩</p>           
            </div>
            <div class="col-md-4">
                <p class="text-center">សាក្សី</p>
                <p class="text-center" style="margin-top: 100px">លឹម ច័ន្ទរតនៈ</p>
            </div> 
            <div class="col-md-4">
                <p class="text-center">អ្នកប្រគល់ប្រាក់និងទទួលប្លង់ដី</p>
                <p class="text-center" style="margin-top: 100px">លឹម ច័ន្ទរតនៈ</p>
            </div> 
            <div class="col-md-4">
                <p class="text-center">អ្នកទទួលប្រាក់និងប្រគល់ប្លង់ដី</p>
                <p class="text-center" style="margin-top: 100px">លឹម ច័ន្ទរតនៈ</p>
            </div>       
            
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('footer')
<script>
    $('.dropify').dropify();
</script>
@endsection
