    <label for="curr_idiomas">Idiomas:</label><br/>
            <div >         
                <table class="table"><tbody><tr>
                @for ($i = 0; $i < count($idiomas); $i++)
                <td>
                    <input type='checkbox' name='{{$ent or "ent"}}_idiomas[]' style="margin:10px;" value='{{$idiomas[$i]->id}}'/>{{$idiomas[$i]->nome}}
                </td>
                @if(($i+1)%5==0)</tr><tr>@endif
                @endfor
                </tr>
                </tbody></table>
            </div>