import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { environment } from 'src/environments/environment';
import { User } from '../domain/user.model';
import { Observable } from 'rxjs';

@Injectable({ providedIn: 'root' })
export class UserService {

    private baseUrl = environment.baseUrl;
    
    constructor(private http: HttpClient) {

    }

    getUserByID(id: number): Observable<any> {
        return this.http.get<User>(`${this.baseUrl}/user/${id}`);
    }

    getAll(): Observable<any> {
        return this.http.get<User[]>(`${this.baseUrl}/user`);
    }

    register(user: User): Observable<any> {
        return this.http.post(`${this.baseUrl}/register`, user);
    }

    delete(id: number): Observable<any> {
        return this.http.delete(`${this.baseUrl}/user/${id}`);
    }

    update(id: number, user: User): Observable<any> {
        return this.http.put(`${this.baseUrl}/user/${id}/update`, user);
    }
}