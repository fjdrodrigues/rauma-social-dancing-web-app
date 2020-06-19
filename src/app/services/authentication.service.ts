import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

const httpOptions = {
  headers: new HttpHeaders({ 'Content-Type': 'application/json' })
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