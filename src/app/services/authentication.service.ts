import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';
import { finalize, map } from 'rxjs/operators';
import { User } from '../domain/user.interface';

const httpOptions = {
  headers: new HttpHeaders({ 'Content-Type': 'application/json' }),
  observe: "response" as 'body'
};

@Injectable({
  providedIn: 'root'
})
export class AuthenticationService {

  private baseUrl = environment.baseUrl;

  constructor(private http: HttpClient) { }

  public login(credentials): Observable<any> {
    return this.http.post((`${this.baseUrl}/login`), {
      username: credentials.username,
      password: credentials.password
    }, httpOptions); 
  }
}