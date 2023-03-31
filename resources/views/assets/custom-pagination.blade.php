@if ($paginator->hasPages())
    <div class="pagination" style="width:100%;">
        <div class="row" style="width:100%;background-color::#273866;">
            <div class="col-6 text-left" style="background-color::#273866;">
            {{-- Previous Page Link --}}
            
                @if ($paginator->onFirstPage())
                
                    
                        
                    
                @else
                    <a wire:click="previousPage" href="javascript:void(0)" rel="prev" class="prev-arrow"><i style="margin-top: 35%;height: 30px;" class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                    
                @endif
            </div>
            <div class="col-6  text-right">
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a wire:click="nextPage" href="javascript:void(0)" rel="next" class="next-arrow"><i style="margin-top: 35%;height: 30px;" class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    
                @else
                <!--<a class="prev-arrow"><i style="margin-top: 35%;height: 30px;" class="fa fa-long-arrow-right" aria-hidden="true"></i></a>-->
                @endif
            </div>
        </div>
    </div>
@else 
 <span style="height:55px;"></span>
@endif