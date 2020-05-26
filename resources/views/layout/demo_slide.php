<?php $i=0; ?>
                        @foreach($slide as $sl)
                            <li data-target="#carousel-example-generic" data-slide-to="{{$i}}"
                            @if($i == 0) 
                            class="active"
                            @endif
                            ></li>
                        <?php $i++; ?>
                        @endforeach