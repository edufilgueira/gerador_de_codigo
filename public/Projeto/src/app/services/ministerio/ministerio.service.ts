import { Ministerio } from '../../models/ministerio';
import { Injectable } from '@angular/core';
import { Observable, of } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { catchError, map, tap } from 'rxjs/operators';

//ADD MANUAL
import { VariablesService } from './../../services/variables.service';

const httpOptions = {
  headers: new HttpHeaders({
    'Accept': 'application/json',
    'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQzZmYxODIxNDNkOGIzODQ4ZjIzMzQ1YmNiMDc2NjUzMTE0Y2JmMTRlM2M4Nzk0OGFkMzQ0NGYxYWU3MTM5MjRiMjdjMDU1YmM4NDYxMGZmIn0.eyJhdWQiOiIxIiwianRpIjoiZDNmZjE4MjE0M2Q4YjM4NDhmMjMzNDViY2IwNzY2NTMxMTRjYmYxNGUzYzg3OTQ4YWQzNDQ0ZjFhZTcxMzkyNGIyN2MwNTViYzg0NjEwZmYiLCJpYXQiOjE1NTkxODgyMjAsIm5iZiI6MTU1OTE4ODIyMCwiZXhwIjoxNTkwODEwNjIwLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.B0CIQBK98xikoIAq28JjEosFRvIxaZ8vGtUhrK5SKeU-b0RuAKcfXzQzZmPDyg_CyYOb1KF7VQ0odxK5cIw9wXmRSGMNK-Gdo7sqqN5SZKgd-rIm91gukqbHnxj_rFoCjBuRgblMgvEvlq22IuCT3n0jvSGWhcq3NXfU7-O0V56LPg9ShcQ41U3HkY5LOdDsDM-GRHCI0fiYZ9rFjmRfGZd0PFyvuaNzfd6oEL9eTTcgZBTA8gBi2b9UwDoSA55q0ly8g1Ph9RLoBGLuWpKVwACJ-rfMenVe4UjckCmDCcxn3x37tLe74RDUnjhM3e__uOHCjdLDwmplrd9qhN5S9E3ZAITMyiDVfC8w2840QNLmCKYqyUM23ctLf0nKLoarDteRpS8teoayeJOkzOt4NTXJ3-2IwWS1iemq6JqAqpU07Zy0ig9VTCoL0mPjjDmHSzrQyanUHmGVhF-0HVvNhLGjxyKI65GtVrPKeFbQTj4vIx42fV6bLyuSfT33SUTFR_UUwjSetITpLiRfnQ_wRbVGJuhnEF8382Hg012uXzSzTMDnRcVXxZdtphRApCnH_i6bI6O5Oek2m1NyinlkNAW8jlbX1Bhp013gtcALLAWYPS1JvRezj_u5vS-Gt_p5MGhD56omAgWuPD1AXfrnfeRYwHIssv7-PUp6HdqZwpA'})
};

const head= new HttpHeaders() .append('accept', 'application/json') .append('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQzZmYxODIxNDNkOGIzODQ4ZjIzMzQ1YmNiMDc2NjUzMTE0Y2JmMTRlM2M4Nzk0OGFkMzQ0NGYxYWU3MTM5MjRiMjdjMDU1YmM4NDYxMGZmIn0.eyJhdWQiOiIxIiwianRpIjoiZDNmZjE4MjE0M2Q4YjM4NDhmMjMzNDViY2IwNzY2NTMxMTRjYmYxNGUzYzg3OTQ4YWQzNDQ0ZjFhZTcxMzkyNGIyN2MwNTViYzg0NjEwZmYiLCJpYXQiOjE1NTkxODgyMjAsIm5iZiI6MTU1OTE4ODIyMCwiZXhwIjoxNTkwODEwNjIwLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.B0CIQBK98xikoIAq28JjEosFRvIxaZ8vGtUhrK5SKeU-b0RuAKcfXzQzZmPDyg_CyYOb1KF7VQ0odxK5cIw9wXmRSGMNK-Gdo7sqqN5SZKgd-rIm91gukqbHnxj_rFoCjBuRgblMgvEvlq22IuCT3n0jvSGWhcq3NXfU7-O0V56LPg9ShcQ41U3HkY5LOdDsDM-GRHCI0fiYZ9rFjmRfGZd0PFyvuaNzfd6oEL9eTTcgZBTA8gBi2b9UwDoSA55q0ly8g1Ph9RLoBGLuWpKVwACJ-rfMenVe4UjckCmDCcxn3x37tLe74RDUnjhM3e__uOHCjdLDwmplrd9qhN5S9E3ZAITMyiDVfC8w2840QNLmCKYqyUM23ctLf0nKLoarDteRpS8teoayeJOkzOt4NTXJ3-2IwWS1iemq6JqAqpU07Zy0ig9VTCoL0mPjjDmHSzrQyanUHmGVhF-0HVvNhLGjxyKI65GtVrPKeFbQTj4vIx42fV6bLyuSfT33SUTFR_UUwjSetITpLiRfnQ_wRbVGJuhnEF8382Hg012uXzSzTMDnRcVXxZdtphRApCnH_i6bI6O5Oek2m1NyinlkNAW8jlbX1Bhp013gtcALLAWYPS1JvRezj_u5vS-Gt_p5MGhD56omAgWuPD1AXfrnfeRYwHIssv7-PUp6HdqZwpA');

const apiUrl = VariablesService.getUrlServer()+'age_ranges';

@Injectable({
  providedIn: 'root'
})

export class AgeRangeService {

  constructor(
    private httpClient: HttpClient
    ) { }
  
  index(next_page_url): Observable<AgeRange[]> {
    var url = (next_page_url) ? next_page_url:apiUrl;
    return this.httpClient.get<AgeRange[]>(url,{headers:head})
      .pipe(
        tap(data => console.log('fetched AgeRange')),
        catchError(this.handleError('AgeRange', []))
      );
  }

  search(field, value, next_page_url): Observable<AgeRange[]> {
    var url = (next_page_url) ? next_page_url+'&'+field+'=*'+value+'*' : apiUrl+'?'+field+'=*'+value+'*';
    return this.httpClient.get<AgeRange[]>(url)
      .pipe(
        tap(data => console.log('api search AgeRange')),
        catchError(this.handleError('search AgeRange', []))
      );
  }

  show(id): Observable<AgeRange> {
    const url = apiUrl+'/'+id;
    console.log('testendo.... '+url);
    return this.httpClient.get<AgeRange>(url).pipe(
      tap(_ => this.log('fetched AgeRange id='+id)),
      catchError(this.handleError<AgeRange>('AgeRange id='+id))
    );
  }

  create(data): Observable<any> {
    return this.httpClient.post(apiUrl, data, httpOptions)
      .pipe(
        catchError(this.handleError)
      );
  }

  update(id, ageRange): Observable<any> {
    const url = apiUrl+'/'+id;
    return this.httpClient.put(url, ageRange, httpOptions).pipe(
      tap(_ => this.log('updated AgeRange id='+id)),
      catchError(this.handleError<any>('AgeRange'))
    );
  }

  destroy(id): Observable<AgeRange> {
    const url = apiUrl+'/'+id;
    return this.httpClient.delete<AgeRange>(url, httpOptions).pipe(
      tap(_ => this.log(`deleted AgeRange`)),
      catchError(this.handleError<AgeRange>('AgeRange'))
    );
  }

  /**
 * Handle Http operation that failed.
 * Let the app continue.
 * @param operation - name of the operation that failed
 * @param result - optional value to return as the observable result
 */
  private handleError<T> (operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {

      // TODO: send the error to remote logging infrastructure
      console.error(error); // log to console instead

      // TODO: better job of transforming error for user consumption
      this.log(operation + 'failed: ' + error.message);

      // Let the app keep running by returning an empty result.
      return of(result as T);
    };
  }

  private log(message: string) {
     console.log('Service: '+ message);
  }
}